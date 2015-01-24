<?php


namespace Auth;


use Silex\Application,
    Silex\ServiceProviderInterface;

class ApiKeyUserServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['user.repository'] = $app->share(function() use ($app) {
            return $app['orm.em']->getRepository('Ttf\Mapping\User');
        });

        $app['security.user_provider.apikey'] = $app->protect(function () use ($app) {
            return new ApiKeyUserProvider($app['user.repository']);
        });

        return true;
    }

    public function boot(Application $app)
    {
    }
}