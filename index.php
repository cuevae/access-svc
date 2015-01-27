<?php

require_once 'vendor/autoload.php';

use Auth\ApiKeyAuthenticationServiceProvider,
    Auth\ApiKeyUserServiceProvider;
use Silex\Application as Router;
use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\Config\FileLocator,
    Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Propel\Runtime\Propel,
    Propel\Runtime\Connection\ConnectionManagerSingle;
use Monolog\Logger,
    Monolog\Handler\StreamHandler;

/***********************
 * General configuration
 ***********************/

/*
 * DI config
 */
$container = new ContainerBuilder();
$configurationDirectories = new FileLocator( array( __DIR__ . '/config/resources' ) );
$loader = new XmlFileLoader( $container, $configurationDirectories );
$loader->load( 'di-config.xml' );

/*
 * Database config
 */
$serviceContainer = Propel::getServiceContainer();
$serviceContainer->setAdapterClass( 'abcbank', 'mysql' );
$manager = new ConnectionManagerSingle();
$manager->setConfiguration(
    array(
        'dsn' => 'mysql:host=localhost;dbname=abcbank',
        'user' => 'root',
        'password' => '',
    )
);
$serviceContainer->setConnectionManager( 'abcbank', $manager );

/*
 * Database logger
 */
$serviceContainer = Propel::getServiceContainer();
$defaultLogger = new Logger( 'defaultLogger' );
$defaultLogger->pushHandler( new StreamHandler( __DIR__ . '/log/database/propel.log', Logger::DEBUG ) );
$serviceContainer->setLogger( 'defaultLogger', $defaultLogger );


/*
 * API database
 */
$serviceContainer = Propel::getServiceContainer();
$serviceContainer->setAdapterClass( 'abcbank_api', 'mysql' );
$manager = new ConnectionManagerSingle();
$manager->setConfiguration(
    array(
        'dsn' => 'mysql:host=localhost;dbname=abcbank_api',
        'user' => 'root',
        'password' => '',
    )
);
$serviceContainer->setConnectionManager( 'abcbank_api', $manager );

/**********************
 * Router configuration
 **********************/
$app = new Router();
$app['debug'] = true;

/*
 * Router services
 */
$app->register(
    new Silex\Provider\MonologServiceProvider(),
    array(
        'monolog.logfile' => __DIR__ . '/log/router/development.log',
    )
);
$app->register( new ApiKeyUserServiceProvider() );
$app->register(
    new ApiKeyAuthenticationServiceProvider(),
    array(
        'security.apikey.param' => 'apikey',
    )
);
$app->register(
    new Silex\Provider\SecurityServiceProvider(),
    array(
        'security.firewalls' => array(
            'api' => array(
                'apikey' => true,
                'pattern' => '^/*',
                'stateless' => true,
            )
        )
    )
);

/**
 * Security access rules
 */
$app['security.access_rules'] = array();

$app['security.role_hierarchy'] = array(
    'ROLE_ADMIN' => array( 'ROLE_CLIENT', 'ROLE_ALLOWED_TO_SWITCH' ),
);


/**
 * Router endpoints
 */

$clients = $app['controllers_factory'];

$mustBeClientOrAdmin = function ( $clientId ) use ( $app ){
    $token = $app['security']->getToken();

    if($app['security']->isGranted( 'ROLE_ADMIN' )){
        $client = \AbcBank\Resources\ClientQuery::create()->findById( $clientId )->getFirst();
    }else{
        $client = \AbcBank\Resources\ClientQuery::create()->findPk(
            array( $clientId, $token->getuser()->getUsername() )
        );
    }

    return $client;
};

$app->before(
    function ( Request $request ){
        if(0 === strpos( $request->headers->get( 'Content-Type' ), 'application/json' )){
            $data = json_decode( preg_replace( '/(\n|\t)/', '', $request->getContent() ), true );
            $request->request->replace( is_array( $data ) ? $data : array() );
        }
    }
);

$app->get(
    '/clients',
    function ( Request $req ) use ( $app ){

        $query = $req->get( 'query', false );

        $dbFetch = \AbcBank\Resources\ClientQuery::create();
        if($query){
            $dbFetch->condition( 'c1', 'Client.FirstName LIKE ?', "%$query%" )
                    ->condition( 'c2', 'Client.SecondName LIKE ?', "%$query%" )
                    ->condition( 'c3', 'Client.FirstSurname LIKE ?', "%$query%" )
                    ->condition( 'c4', 'Client.SecondSurname LIKE ?', "%$query%" )
                    ->condition( 'c5', 'Client.Username LIKE ?', "%$query%" )
                    ->where( array( 'c1', 'c2', 'c3', 'c4', 'c5' ), 'or' );
        }
        $clients = $dbFetch->find();

        return new Response(
            $clients->toJson(),
            200,
            array( 'Content-type' => 'application/json' )
        );
    }
);

$app->post(
    '/clients',
    function ( Request $req ) use ( $app ){

        if(!$app['security']->isGranted( 'ROLE_ADMIN' )){
            return new Response( '', 403 );
        }

        $client = new \AbcBank\Resources\Client();
        try{
            $client->fromArray( $req->request->all() );
            if($client->validate()){
                $client->save();
            }else{
                $errors = new \StdClass();
                $count = 1;
                foreach($client->getValidationFailures() as $failure){
                    $errors->{"error" . $count++} = "Property " . $failure->getPropertyPath(
                        ) . ": " . $failure->getMessage();
                }
                return new Response(
                    json_encode( $errors ),
                    400,
                    array( 'Content-type' => 'application/json' )
                );
            }
        }catch( Exception $e ){
            $app['monolog']->addError( $e->getMessage() );
            $app->abort( 400, "Client could not be saved." );
        }

        return new Response(
            $client->toJson(),
            201,
            array( 'Content-type' => 'application/json' )
        );
    }
);

$app->get(
    '/clients/{clientId}',
    function ( $clientId ) use ( $app, $mustBeClientOrAdmin ){
        $client = $mustBeClientOrAdmin( $clientId );
        if(!$client){
            $app->abort( 404, 'Client not found.' );
        }

        return new Response(
            $client->toJson(),
            200,
            array( 'Content-type' => 'application/json' )
        );
    }
);

$app->get(
    '/clients/{clientId}/addresses',
    function ( $clientId ) use ( $app, $mustBeClientOrAdmin ){
        $client = $mustBeClientOrAdmin( $clientId );
        if(!$client){
            $app->abort( 404, "Client not found." );
        }
        $addresses = $client->getAddresses();

        return new Response(
            $addresses->toJson(),
            200,
            array( 'Content-type' => 'application/json' )
        );
    }
);

$app->get(
    '/clients/{clientId}/accounts',
    function ( $clientId ) use ( $app, $mustBeClientOrAdmin ){
        $client = $mustBeClientOrAdmin( $clientId );
        if(!$client){
            $app->abort( 404, "Client not found." );
        }
        $accounts = $client->getAccounts();

        return new Response(
            $accounts->toJson(),
            200,
            array( 'Content-type' => 'application/json' )
        );
    }
);

$app->post(
    '/clients/{clientId}/accounts',
    function ( Request $req, $clientId ) use ( $app, $mustBeClientOrAdmin ){
        $client = $mustBeClientOrAdmin( $clientId );
        if(!$client){
            $app->abort( 404, "Client not found." );
        }

        $account = new \AbcBank\Resources\Account();
        try{
            $account->fromArray( $req->request->all() );
            $account->save();
        }catch( Exception $e ){
            $app['monolog']->addError( $e->getMessage() );
            $app->abort( 400, "Account could not be saved." );
        }

        return new Response(
            $account->toJson(),
            201,
            array( 'Content-type' => 'application/json' )
        );
    }
);

$app->run();