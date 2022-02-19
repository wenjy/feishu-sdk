<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

/**
 * @date: 16:59 2022/2/15
 */
class EncryptorTest extends TestCase
{
    /**
     * 测试解密
     * 因为加密字符串随机所以不测试加密
     */
    public function testDecrypt()
    {
        $encrypt = new \FeiShu\Kernel\Encryptor('kudryavka');
        $res = $encrypt->decrypt('fgB2DDMdzGQ2yPn14E85+Cja/C+F+uRzoXozowIB9fXDGFtTXYr2RsuBwgzRvebN5HwyFttBZfLs2Egt4lEWHg==');
        $this->assertEquals('{"uuid":"5226cd85b4d843dccee2e279d93f3ed3"}', $res);
    }
}
