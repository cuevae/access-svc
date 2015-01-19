<?php

require_once 'vendor/autoload.php';
require( 'vendor/palanik/corsslim/CorsSlim.php' );

use \Slim\Slim as SlimRouter;
use \CorsSlim\CorsSlim as CORSMiddleware;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

$configDirectories = array( __DIR__ . '/config/server' );
$locator = new FileLocator( $configDirectories );

$corsConfig = Yaml::parse( $locator->locate( 'cors.yml', null, true ) );

$router = new SlimRouter();
$router->add( new CORSMiddleware( $corsConfig ) );


/**
 * Routes
 */

$router->get(
    '/',
    function (){
        echo "Hello world!";
    }
);

$router->get(
    '/authenticate/?',
    function () use ( $router ){
        echo "Authenticating";
        echo "API key received: " . $router->request()->get('apikey');
    }
);

$router->run();