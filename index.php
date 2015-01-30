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

$customers = $app['controllers_factory'];

$mustBeCustomerOrAdmin = function ( $customerId ) use ( $app ){
    $token = $app['security']->getToken();

    if($app['security']->isGranted( 'ROLE_ADMIN' )){
        $customer = \AbcBank\Resources\CustomerQuery::create()->findById( $customerId )->getFirst();
    }else{
        $customer = \AbcBank\Resources\CustomerQuery::create()->findPk(
            array( $customerId, $token->getuser()->getUsername() )
        );
    }

    return $customer;
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
    '/customers',
    function ( Request $req ) use ( $app ){

        $query = $req->get( 'query', false );

        $dbFetch = \AbcBank\Resources\CustomerQuery::create();
        if($query){
            $dbFetch->condition( 'c1', 'Customer.FirstName LIKE ?', "%$query%" )
                    ->condition( 'c2', 'Customer.SecondName LIKE ?', "%$query%" )
                    ->condition( 'c3', 'Customer.FirstSurname LIKE ?', "%$query%" )
                    ->condition( 'c4', 'Customer.SecondSurname LIKE ?', "%$query%" )
                    ->condition( 'c5', 'Customer.Username LIKE ?', "%$query%" )
                    ->where( array( 'c1', 'c2', 'c3', 'c4', 'c5' ), 'or' );
        }
        $customers = $dbFetch->find();

        return new Response(
            $customers->toJson(),
            200,
            array( 'Content-type' => 'application/json' )
        );
    }
);

$app->post(
    '/customers',
    function ( Request $req ) use ( $app ){

        if(!$app['security']->isGranted( 'ROLE_ADMIN' )){
            return new Response( '', 403 );
        }

        $customer = new \AbcBank\Resources\Customer();
        try{
            $customer->fromArray( $req->request->all() );
            if($customer->validate()){
                $customer->save();
            }else{
                $errors = new \StdClass();
                $count = 1;
                foreach($customer->getValidationFailures() as $failure){
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
            $app->abort( 400, "Customer could not be saved." );
        }

        return new Response(
            $customer->toJson(),
            201,
            array( 'Content-type' => 'application/json' )
        );
    }
);

$app->get(
    '/customers/{customerId}',
    function ( $customerId ) use ( $app, $mustBeCustomerOrAdmin ){
        $customer = $mustBeCustomerOrAdmin( $customerId );
        if(!$customer){
            $app->abort( 404, 'Customer not found.' );
        }

        return new Response(
            $customer->toJson(),
            200,
            array( 'Content-type' => 'application/json' )
        );
    }
);

$app->delete(
    '/customers/{customerId}',
    function ( $customerId ) use ( $app ){

        if(!$app['security']->isGranted( 'ROLE_ADMIN' )){
            return new Response( '', 403 );
        }

        $customer = \AbcBank\Resources\CustomerQuery::create()->findById( $customerId )->getFirst();
        if($customer){
            $customer->delete();
        }

        return new Response(
            "",
            204,
            array( 'Content-type' => 'application/json' )
        );
    }
);

$app->get(
    '/customers/{customerId}/addresses',
    function ( $customerId ) use ( $app, $mustBeCustomerOrAdmin ){
        $customer = $mustBeCustomerOrAdmin( $customerId );
        if(!$customer){
            $app->abort( 404, "Customer not found." );
        }
        $addresses = $customer->getAddresses();

        return new Response(
            $addresses->toJson(),
            200,
            array( 'Content-type' => 'application/json' )
        );
    }
);

$app->get(
    '/customers/{customerId}/accounts',
    function ( $customerId ) use ( $app, $mustBeCustomerOrAdmin ){
        $customer = $mustBeCustomerOrAdmin( $customerId );
        if(!$customer){
            $app->abort( 404, "Customer not found." );
        }
        $accounts = $customer->getAccounts();

        return new Response(
            $accounts->toJson(),
            200,
            array( 'Content-type' => 'application/json' )
        );
    }
);

$app->post(
    '/customers/{customerId}/accounts',
    function ( Request $req, $customerId ) use ( $app ){

        if(!$app['security']->isGranted( 'ROLE_ADMIN' )){
            return new Response( '', 403 );
        }

        $account = new \AbcBank\Resources\Account();
        try{
            $data = $req->request->all() + [ 'CustomerId' => $customerId ];
            $account->fromArray( $data );

            //Initial balance
            $initialBalanceValidated = true;
            if(isset( $data['InitialBalance'] ) && $data['InitialBalance'] !== 0){
                //Start account with initial balance
                $balance = $data['InitialBalance'];
                $type = ( $balance > 0 ) ? 'deposit' : 'withdrawal';
                $transData = array(
                    'Type' => $type,
                    'Amount' => abs( $balance ),
                    'CustomerId' => $customerId,
                    'AccountNumber' => $account->getAccountNumber()
                );
                $transaction = new \AbcBank\Resources\Transaction();
                $transaction->fromArray( $transData );
                $initialBalanceValidated = $transaction->validate();
            }

            if($account->validate() && $initialBalanceValidated){
                $account->save();
                if(isset( $transaction )){
                    $transaction->save();
                }
            }else{
                $errors = new \StdClass();
                $count = 1;

                foreach($account->getValidationFailures() as $failure){
                    $errors->{"error" . $count++} = "Property " . $failure->getPropertyPath(
                        ) . ": " . $failure->getMessage();
                }

                if(isset( $transaction )){
                    foreach($transaction->getValidationFailures() as $failure){
                        $errors->{"error" . $count++} = "Property " . $failure->getPropertyPath(
                            ) . ": " . $failure->getMessage();
                    }
                }

                return new Response(
                    json_encode( $errors ),
                    400,
                    array( 'Content-type' => 'application/json' )
                );
            }
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

$app->get(
    '/customers/{customerId}/accounts/{accNumber}',
    function ( $customerId, $accNumber ) use ( $app, $mustBeCustomerOrAdmin ){
        /** @var \AbcBank\Resources\Customer $customer */
        $customer = $mustBeCustomerOrAdmin( $customerId );
        if(!$customer){
            $app->abort( 404, "Account not found." );
        }

        $account = \AbcBank\Resources\AccountQuery::create()
                                                  ->filterByCustomerId( $customerId )
                                                  ->filterByAccountNumber( $accNumber )
                                                  ->find()->getFirst();
        if(!$account){
            $app->abort( 404, "Account not found." );
        }

        return new Response(
            $account->toJson(),
            200,
            array( 'Content-type' => 'application/json' )
        );
    }
);

$app->delete(
    '/customers/{customerId}/accounts/{accNumber}',
    function ( $customerId, $accNumber ) use ( $app ){
        if(!$app['security']->isGranted( 'ROLE_ADMIN' )){
            return new Response( '', 403 );
        }

        $account = \AbcBank\Resources\AccountQuery::create()->findByAccountNumber( $accNumber )->getFirst();
        if($account && $account->getCustomerId() == $customerId){
            $account->delete();
        }

        return new Response(
            "",
            204,
            array( 'Content-type' => 'application/json' )
        );
    }
);

$app->post(
    '/customers/{customerId}/accounts/{accNumber}/deposit',
    function ( Request $req, $customerId, $accNumber ) use ( $app, $mustBeCustomerOrAdmin ){
        $customer = $mustBeCustomerOrAdmin( $customerId );
        if(!$customer){
            $app->abort( 404, "Customer not found." );
        }

        $amount = $req->request->get( 'Amount' );
        $transaction = new \AbcBank\Resources\Transaction();
        try{
            $transaction->fromArray(
                array(
                    'CustomerId' => $customerId,
                    'AccountNumber' => $accNumber,
                    'Type' => 'deposit',
                    'Amount' => $amount
                )
            );
            if($transaction->validate()){
                $transaction->save();
            }else{
                $errors = new \StdClass();
                $count = 1;
                foreach($transaction->getValidationFailures() as $failure){
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
            $app->abort( 400, "Customer could not be saved." );
        }

        return new Response(
            $transaction->toJson(),
            201,
            array( 'Content-type' => 'application/json' )
        );
    }
);

$app->post(
    '/customers/{customerId}/accounts/{accNumber}/withdrawal',
    function ( Request $req, $customerId, $accNumber ) use ( $app, $mustBeCustomerOrAdmin ){
        $customer = $mustBeCustomerOrAdmin( $customerId );
        if(!$customer){
            $app->abort( 404, "Customer not found." );
        }

        $amount = $req->request->get( 'Amount' );
        $transaction = new \AbcBank\Resources\Transaction();
        try{
            $transaction->fromArray(
                array(
                    'CustomerId' => $customerId,
                    'AccountNumber' => $accNumber,
                    'Type' => 'withdrawal',
                    'Amount' => $amount
                )
            );
            if($transaction->validate()){
                $transaction->save();
            }else{
                $errors = new \StdClass();
                $count = 1;
                foreach($transaction->getValidationFailures() as $failure){
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
            $app->abort( 400, "Customer could not be saved." );
        }

        return new Response(
            $transaction->toJson(),
            201,
            array( 'Content-type' => 'application/json' )
        );
    }
);

$app->get(
    '/customers/{customerId}/accounts/{accNumber}/transactions',
    function ( Request $req, $customerId, $accNumber ) use ( $app, $mustBeCustomerOrAdmin ){
        $customer = $mustBeCustomerOrAdmin( $customerId );
        if(!$customer){
            $app->abort( 404, "Customer not found." );
        }

        $page = $req->query->get( 'page' ) ?: 1;
        $maxPerPage = $req->query->get( 'limit' ) ?: 10;
        $type = $req->query->get( 'type' );
        $transactions = \AbcBank\Resources\TransactionQuery::create()
                                                           ->filterByAccountNumber( $accNumber )
                                                           ->filterByCustomerId( $customerId );
        if($type && in_array( $type, array( 'deposit', 'withdrawal' ) )){
            $transactions->filterByType( $type );
        }

        $transactions = $transactions->orderByCreatedAt( \Propel\Runtime\ActiveQuery\Criteria::DESC )
                                     ->paginate( $page, $maxPerPage );


        return new Response(
            $transactions->toJson(),
            201,
            array(
                'Content-type' => 'application/json',
                'X-Total-Pages' => $transactions->getLastPage(),
                'X-Current-Page' => $transactions->getPage(),
                'X-Limit' => $transactions->getMaxPerPage()
            )
        );
    }
);

$app->run();