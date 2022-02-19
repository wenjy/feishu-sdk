<?php

namespace FeiShu\OpenPlatform\Contact\Users;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider.
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        isset($app['user']) || $app['user'] = function ($app) {
            return new Client($app);
        };
    }
}
