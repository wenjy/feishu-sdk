<?php
/**
 * @date: 11:04 2022/2/19
 */

namespace FeiShu\OpenPlatform\Approval\Instances;

use FeiShu\Kernel\BaseClient;
use FeiShu\Kernel\Exceptions\InvalidArgumentException;
use FeiShu\Kernel\Exceptions\InvalidConfigException;
use FeiShu\Kernel\Support\Collection;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * instance Client
 */
class Client extends BaseClient
{
    /**
     * @var string
     */
    protected $endpoint = '/approval/openapi/v2/instance';

    /**
     * 创建一个审批实例
     * @param array $params
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function createInstance(array $params)
    {
        return $this->httpPostJson($this->endpoint . '/create', $params);
    }

    /**
     * 得到审批实例的详情
     * @param string $instanceCode
     * @param string $userId
     * @param string $openId
     * @return array|Collection|object|ResponseInterface|string
     * @throws GuzzleException
     * @throws InvalidConfigException
     */
    public function getInstance(string $instanceCode, string $userId = '', string $openId = '')
    {
        $params = [
            'instance_code' => $instanceCode
        ];
        if ($userId) {
            $params['user_id'] = $userId;
        }
        if ($openId) {
            $params['open_id'] = $openId;
        }
        return $this->httpPostJson($this->endpoint . '/get', $params);
    }

    /**
     * 搜索审批实例接口
     * @param string $userId
     * @param string $approvalCode
     * @param string $instanceCode
     * @return array|Collection|object|ResponseInterface|string
     * @throws GuzzleException
     * @throws InvalidConfigException
     * @throws InvalidArgumentException
     */
    public function searchInstance(string $userId = '', string $approvalCode = '', string $instanceCode = '')
    {
        $params = [];
        if ($userId) {
            $params['user_id'] = $userId;
        }
        if ($approvalCode) {
            $params['approval_code'] = $approvalCode;
        }
        if ($instanceCode) {
            $params['instance_code'] = $instanceCode;
        }
        if (empty($params)) {
            throw new InvalidArgumentException('Parameters cannot all be empty');
        }
        return $this->httpPostJson($this->endpoint . '/search', $params);
    }
}
