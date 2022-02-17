<?php

namespace FeiShu\OpenPlatform\Auth;

use FeiShu\Kernel\AccessToken as BaseAccessToken;

/**
 * Class AccessToken.
 */
class AccessToken extends BaseAccessToken
{
    /**
     * @var string
     */
    protected $endpointToGetToken = '/open-apis/auth/v3/app_access_token/internal';

    /**
     * @var int
     */
    protected $safeSeconds = 0;

    /**
     * Credential for get token.
     *
     * @return array
     */
    protected function getCredentials(): array
    {
        return [
            'app_id' => $this->app['config']['app_id'],
            'app_secret' => $this->app['config']['app_secret'],
        ];
    }
}
