<?php
/**
 * @date: 11:04 2022/2/19
 */

namespace FeiShu\OpenPlatform\Contact\Users;

use FeiShu\Kernel\BaseClient;
use FeiShu\Kernel\Exceptions\InvalidConfigException;
use FeiShu\Kernel\Support\Collection;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * Departments Client
 */
class Client extends BaseClient
{
    /**
     * @var string
     */
    protected $endpoint = '/open-apis/contact/v3/users';

    /**
     * 获取单个用户详情
     * @param string $openId
     * @param string $userIdType
     * @param string $departmentIdType
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function getDetail(string $openId, string $userIdType = 'open_id', string $departmentIdType = 'department_id')
    {
        return $this->httpGet($this->endpoint . '/' . $openId, [
                'user_id_type' => $userIdType,
                'department_id_type' => $departmentIdType
        ]);
    }

    /**
     * 获取用户列表 根据部门获取
     * @param string $departmentId
     * @param string $userIdType
     * @param string $departmentIdType
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function getList(string $departmentId = '0', string $userIdType = 'open_id', string $departmentIdType = 'open_department_id')
    {
        return $this->httpGet($this->endpoint . '/find_by_department', [
                'user_id_type' => $userIdType,
                'department_id_type' => $departmentIdType,
                'department_id' => $departmentId
        ]);
    }
}
