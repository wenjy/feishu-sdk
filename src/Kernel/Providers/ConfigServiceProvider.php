<?php

namespace FeiShu\Kernel\Providers;

use FeiShu\Kernel\Config;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ConfigServiceProvider.
 */
class ConfigServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        !isset($pimple['config']) && $pimple['config'] = function ($app) {
            return new Config($app->getConfig());
        };
    }
}
