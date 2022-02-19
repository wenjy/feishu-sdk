<?php

namespace FeiShu\OpenPlatform;

use FeiShu\Kernel\ServiceContainer;
use FeiShu\OpenPlatform\Auth\AccessToken;
use FeiShu\OpenPlatform\Contact\Departments\Client as DepartmentClient;
use Overtrue\Socialite\Providers\FeiShu;

/**
 * @property AccessToken $access_token
 * @property FeiShu $oauth
 * @property DepartmentClient $department
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        OAuth\ServiceProvider::class,
        Contact\Departments\ServiceProvider::class,
        Contact\Users\ServiceProvider::class,
        Approval\Instances\ServiceProvider::class,
        Approval\Subscribe\ServiceProvider::class
    ];
}
