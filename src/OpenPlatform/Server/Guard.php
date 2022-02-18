<?php

namespace FeiShu\OpenPlatform\Server;

use FeiShu\Kernel\Exceptions\BadRequestException;
use FeiShu\Kernel\Exceptions\InvalidArgumentException;
use FeiShu\Kernel\Exceptions\InvalidConfigException;
use FeiShu\Kernel\Exceptions\RuntimeException;
use FeiShu\Kernel\ServerGuard;
use FeiShu\OpenPlatform\Server\Handlers\Authorized;
use Symfony\Component\HttpFoundation\Response;
use function FeiShu\Kernel\data_get;

/**
 * Class Guard.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Guard extends ServerGuard
{
    public const EVENT_AUTHORIZED = 'authorized';

    /**
     * @return Response
     *
     * @throws BadRequestException
     * @throws InvalidArgumentException
     * @throws InvalidConfigException
     * @throws RuntimeException
     */
    protected function resolve(): Response
    {
        $this->registerHandlers();

        $message = $this->getMessage();

        if ($infoType = data_get($message, 'InfoType')) {
            $this->dispatch($infoType, $message);
        }

        return new Response(static::SUCCESS_EMPTY_RESPONSE);
    }

    /**
     * Register event handlers.
     */
    protected function registerHandlers()
    {
        $this->on(self::EVENT_AUTHORIZED, Authorized::class);
    }
}
