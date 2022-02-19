<?php

namespace FeiShu;

use FeiShu\OpenPlatform\Application as OpenPlatformServiceApplication;
use FeiShu\Kernel\ServiceContainer;

/**
 * @method static OpenPlatformServiceApplication openPlatform(array $config)
 */
class Factory
{
    /**
     * @param string $name
     * @param array  $config
     *
     * @return ServiceContainer
     */
    public static function make($name, array $config)
    {
        $namespace = Kernel\Support\Str::studly($name);
        $application = "\\FeiShu\\{$namespace}\\Application";

        return new $application($config);
    }

    /**
     * Dynamically pass methods to the application.
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }
}
