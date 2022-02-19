<?php
/**
 * @date: 11:04 2022/2/19
 */

namespace FeiShu\OpenPlatform\Approval\Subscribe;

use FeiShu\Kernel\BaseClient;
use FeiShu\Kernel\Exceptions\InvalidConfigException;
use FeiShu\Kernel\Support\Collection;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * 订阅审批
 * Subscribe Client
 */
class Client extends BaseClient
{
    /**
     * @var string
     */
    protected $endpoint = '/approval/openapi/v2/subscription';

    /**
     * 订阅审批事件
     * @param string $approval_code
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function subscribe(string $approval_code)
    {
        return $this->httpPostJson($this->endpoint . '/subscribe', ['approval_code' => $approval_code]);
    }

    /**
     * 取消订阅审批事件
     * @param string $approval_code
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function unsubscribe(string $approval_code)
    {
        return $this->httpPostJson($this->endpoint . '/unsubscribe', ['approval_code' => $approval_code]);
    }
}
