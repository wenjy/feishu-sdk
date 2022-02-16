<?php

namespace FeiShu;

class Factory
{
    public static function make($name, array $config)
    {
        $namespace = Kernel\Support\Str::studly($name);
        $application = "\\FeiShu\\{$namespace}\\Application";

        return new $application($config);
    }
}
