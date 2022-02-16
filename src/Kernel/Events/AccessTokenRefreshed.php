<?php

namespace FeiShu\Kernel\Events;

use FeiShu\Kernel\AccessToken;

/**
 * Class AccessTokenRefreshed.
 */
class AccessTokenRefreshed
{
    /**
     * @var AccessToken
     */
    public $accessToken;

    /**
     * @param AccessToken $accessToken
     */
    public function __construct(AccessToken $accessToken)
    {
        $this->accessToken = $accessToken;
    }
}
