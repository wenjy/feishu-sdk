<?php

namespace FeiShu\OpenPlatform\OAuth;

use Overtrue\Socialite\SocialiteManager as Socialite;
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
        $app['oauth'] = function ($app) {
            $feishu = [
                'feishu' => [
                    'client_id' => $app['config']['app_id'],
                    'client_secret' => $app['config']['app_secret'],
                    'redirect' => $this->prepareCallbackUrl($app),
                    //'app_mode' => 'internal'
                ],
            ];

            return (new Socialite($feishu))->create('feishu');
        };
    }

    /**
     * Prepare the OAuth callback url.
     *
     * @param Container $app
     *
     * @return string
     */
    private function prepareCallbackUrl($app)
    {
        $callback = $app['config']->get('oauth.callback');
        if (0 === stripos($callback, 'http')) {
            return $callback;
        }
        $baseUrl = $app['request']->getSchemeAndHttpHost();

        return $baseUrl . '/' . ltrim($callback, '/');
    }
}
