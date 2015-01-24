<?php

require_once 'vendor/autoload.php';

use Auth\ApiKeyAuthenticationServiceProvider,
    Auth\ApiKeyUserServiceProvider;

$app = new \Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/development.log',
));

$app->register(new ApiKeyUserServiceProvider());
$app->register(new ApiKeyAuthenticationServiceProvider(), array(
    'security.apikey.param' => 'access_token',
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

$account = $app['controllers_factory'];

$account->get('/', function(){
   return "Secured";
});

$app->mount('/account', $account);
$app->run();