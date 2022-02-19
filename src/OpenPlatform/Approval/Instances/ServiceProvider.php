<?php

namespace FeiShu\OpenPlatform\Approval\Instances;

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
        isset($app['instance']) || $app['instance'] = function ($app) {
            return new Client($app);
        };
    }
}
