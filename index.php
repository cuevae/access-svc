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
$configurationDirectories = new FileLocator(array(__DIR__ . '/config/resources'));
$loader = new XmlFileLoader($container, $configurationDirectories);
$loader->load('di-config.xml');

/*
 * Database config
 */
$serviceContainer = Propel::getServiceContainer();
$serviceContainer->setAdapterClass('abcbank', 'mysql');
$manager = new ConnectionManagerSingle();
$manager->setConfiguration(array (
    'dsn'      => 'mysql:host=localhost;dbname=abcbank',
    'user'     => 'root',
    'password' => '',
));
$serviceContainer->setConnectionManager('abcbank', $manager);

/*
 * Database logger
 */
$serviceContainer = Propel::getServiceContainer();
$defaultLogger = new Logger('defaultLogger');
$defaultLogger->pushHandler(new StreamHandler(__DIR__.'log/database/propel.log', Logger::DEBUG));
$serviceContainer->setLogger('defaultLogger', $defaultLogger);

/**********************
 * Router configuration
 **********************/
$app = new Router();
$app['debug'] = true;

/*
 * Router services
 */
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/log/router/development.log',
));
$app->register(new ApiKeyUserServiceProvider());
$app->register(new ApiKeyAuthenticationServiceProvider(), array(
    'security.apikey.param' => 'apikey',
));
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'api' => array(
            'apikey'    => true,
            'pattern'   => '^/*',
            'stateless' => true,
        ),
    )
));


/**
 * Router endpoints
 */

/*
 * Clients
 */

$clients = $app['controllers_factory'];

$clients->get('/', function(Router $app, Request $req) use($container){
    $model = $container->get('account_model');
    $accounts = $model->getAccounts();
    $result = print_r($accounts, true);
    return $result;
});

$clients->get('/savings', function(Router $app, Request $req){
    return 'List of savings account for the current client';
});

$clients->get('/savings/{accId}', function( Router $app, Request $req, $accId){
    return $req->getUri();
});

$clients->post('/savings/{accId}/deposit', function(Router $app, Request $req, $accId){
    return $req->getUri();
});

$clients->post('/savings/{accId}/withdraw', function(Router $app, Request $req, $accId){
    return $req->getUri();
});

$clients->get('/current', function(Router $app, Request $req){
    return 'List of current accounts for the current client';
});

$clients->get('/current/{accId}', function(Router $app, Request $req, $accId){
    return $req->getUri();
});

$clients->post('/current/{accId}/deposit', function(Router $app, Request $req, $accId){
    return $req->getUri();
});

$clients->post('/current/{accId}/withdraw', function(Router $app, Request $req, $accId){
    return $req->getUri();
});

$clients->get('/profile', function(Router $app, Request $req){
    return 'Profile for the current client';
});

$clients->put('/profile', function(Router $app, Request $req){
    return 'Edit current client\'s profile';
});

$app->mount('/clients', $clients);


/*
 * Admin
 */

$admin = $app['controllers_factory'];
$admin->get('/clients', function(){
   return 'Admin';
});

$admin->get('/clients/{clientId}', function($clientId){
    return 'View client ' . $clientId;
});

$admin->post('/clients', function(){
    return "Adding new client!";
});

$app->mount('/admin', $admin);

$app->run();