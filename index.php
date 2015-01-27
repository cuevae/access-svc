<?php

require_once 'vendor/autoload.php';

use Auth\ApiKeyAuthenticationServiceProvider,
    Auth\ApiKeyUserServiceProvider;
use Silex\Application as Router;
use Symfony\Component\HttpFoundation\Request,
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
$app['security.access_rules'] = array(
    array( '^/admin', 'ROLE_ADMIN' ),
    array( '^.*$', 'ROLE_CLIENT' ),
);

$app['security.role_hierarchy'] = array(
    'ROLE_ADMIN' => array( 'ROLE_USER', 'ROLE_ALLOWED_TO_SWITCH' ),
);


/**
 * Router endpoints
 */

$clients = $app['controllers_factory'];

$mustBeClientOrAdmin = function ( $clientId ) use ( $app ){
    $token = $app['security']->getToken();

    if($app['security']->isGranted( 'ROLE_ADMIN' )){
        $client = \AbcBank\Resources\ClientQuery::create()->findById( $clientId );
    }else{
        $client = \AbcBank\Resources\ClientQuery::create()->findPk(
            array( $clientId, $token->getuser()->getUsername() )
        );
    }

    return $client;
};

$clients->get(
    '/{clientId}',
    function ( $clientId ) use ( $app, $mustBeClientOrAdmin ){

        $client = $mustBeClientOrAdmin( $clientId );

        if(!$client){
            $app->abort( 'Client not found.', 404 );
        }

        return new \Symfony\Component\HttpFoundation\Response(
            $client->toJson(),
            200,
            array( 'Content-type' => 'application/json' )
        );
    }
);

$clients->get(
    '/{clientId}/addresses',
    function ( $clientId ) use ( $app, $mustBeClientOrAdmin ){
        $client = $mustBeClientOrAdmin( $clientId );

        if(!$client){
            $app->abort( 404, "Client not found." );
        }

        $addresses = $client->getAddresses();

        return $addresses->toJson();
    }
);

$clients->get(
    '/{clientId}/accounts',
    function ( $clientId ) use ( $app, $mustBeClientOrAdmin ){

        $client = $mustBeClientOrAdmin( $clientId );

        if(!$client){
            $app->abort( 404, "Client not found." );
        }

        $accounts = $client->getAccounts();

        return $accounts->toJson();
    }
);

$app->mount( '/clients', $clients );

$app->run();