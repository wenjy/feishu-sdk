<?php

namespace FeiShu\OpenPlatform\Contact\Departments;

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
        isset($app['department']) || $app['department'] = function ($app) {
            return new Client($app);
        };
    }
}
