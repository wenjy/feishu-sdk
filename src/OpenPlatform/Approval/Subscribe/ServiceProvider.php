<?php

namespace FeiShu\OpenPlatform\Approval\Subscribe;

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
        isset($app['subscribe']) || $app['subscribe'] = function ($app) {
            return new Client($app);
        };
    }
}
