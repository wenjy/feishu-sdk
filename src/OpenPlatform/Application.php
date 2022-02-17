<?php

namespace FeiShu\OpenPlatform;

use FeiShu\Kernel\ServiceContainer;
use FeiShu\OpenPlatform\Auth\AccessToken;
use Overtrue\Socialite\Providers\FeiShu;

/**
 * @property AccessToken $access_token
 * @property FeiShu $oauth
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        OAuth\ServiceProvider::class,
    ];
}
