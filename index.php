<?php

require_once 'vendor/autoload.php';

use Auth\ApiKeyAuthenticationServiceProvider,
    Auth\ApiKeyUserServiceProvider;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

$app = new Application();
$app['debug'] = true;

$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/development.log',
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

$app->get('/', function(Application $app, Request $req){
   return 'List of accounts for the current client';
});

$app->get('/savings', function(Application $app, Request $req){
    return 'List of savings account for the current client';
});

$app->get('/savings/{accId}', function( Application $app, Request $req, $accId){
    return $req->getUri();
});

$app->post('/savings/{accId}/deposit', function(Application $app, Request $req, $accId){
    return $req->getUri();
});

$app->post('/savings/{accId}/withdraw', function(Application $app, Request $req, $accId){
    return $req->getUri();
});

$app->get('/current', function(Application $app, Request $req){
    return 'List of current accounts for the current client';
});

$app->get('/current/{accId}', function(Application $app, Request $req, $accId){
    return $req->getUri();
});

$app->post('/current/{accId}/deposit', function(Application $app, Request $req, $accId){
    return $req->getUri();
});

$app->post('/current/{accId}/withdraw', function(Application $app, Request $req, $accId){
    return $req->getUri();
});

$app->get('/profile', function(Application $app, Request $req){
    return 'Profile for the current client';
});

$app->put('/profile', function(Application $app, Request $req){
    return 'Edit current client\'s profile';
});

$app->run();