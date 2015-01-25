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
$defaultLogger->pushHandler(new StreamHandler(__DIR__.'/log/database/propel.log', Logger::DEBUG));
$serviceContainer->setLogger('defaultLogger', $defaultLogger);


/*
 * API database
 */
$serviceContainer = Propel::getServiceContainer();
$serviceContainer->setAdapterClass('abcbank_api', 'mysql');
$manager = new ConnectionManagerSingle();
$manager->setConfiguration(array (
    'dsn'      => 'mysql:host=localhost;dbname=abcbank_api',
    'user'     => 'root',
    'password' => '',
));
$serviceContainer->setConnectionManager('abcbank_api', $manager);

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

$app->get('/clients/{clientId}', function($clientId){
    return "Viewing profile for client " . $clientId;
});

$app->run();