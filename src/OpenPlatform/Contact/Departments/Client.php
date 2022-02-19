<?php
/**
 * @date: 11:04 2022/2/19
 */

namespace FeiShu\OpenPlatform\Contact\Departments;

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
    protected $endpoint = '/open-apis/contact/v3/departments';

    /**
     * @param int $departmentId
     * @param string $userIdType
     * @param string $departmentIdType
     * @param bool $fetchChild
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function getList(int $departmentId = 0, string $userIdType = 'open_id', string $departmentIdType = 'open_department_id', bool $fetchChild = true)
    {
        return $this->httpGet($this->endpoint . '/' . $departmentId . '/children', [
            'user_id_type' => $userIdType,
            'department_id_type' => $departmentIdType,
            'fetch_child' => $fetchChild,
        ]);
    }

    /**
     * 获取单个部门详细信息
     * @param string $departmentId
     * @param string $userIdType
     * @param string $departmentIdType
     * @return array|Collection|object|ResponseInterface|string
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function getDetail(string $departmentId, string $userIdType = 'open_id', string $departmentIdType = 'department_id')
    {
        return $this->httpGet($this->endpoint . '/' . $departmentId, [
            'user_id_type' => $userIdType,
            'department_id_type' => $departmentIdType,
        ]);
    }
}
