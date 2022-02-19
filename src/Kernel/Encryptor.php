<?php

namespace FeiShu\Kernel;

class Encryptor
{
    /**
     * @var string
     */
    protected string $key;

    /**
     * Encrypt Key加密数据
     * @param string $encryptKey
     */
    public function __construct(string $encryptKey = '')
    {
        $this->key = hash('sha256', $encryptKey, true);
    }

    /**
     * 订阅事件加密
     * @param string $encryptString
     * @return string
     */
    public function encrypt(string $encryptString): string
    {
        $ivlen = openssl_cipher_iv_length($cipher = "AES-256-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($encryptString, $cipher, $this->key, $options = OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv . $ciphertext_raw);
    }

    /**
     * 订阅事件解密
     * @return false|string
     */
    public function decrypt(string $decryptString)
    {
        $decryptString = base64_decode($decryptString);
        $ivlen = openssl_cipher_iv_length($cipher = "AES-256-CBC");
        $iv = substr($decryptString, 0, $ivlen);
        $ciphertext_raw = substr($decryptString, $ivlen);
        return openssl_decrypt($ciphertext_raw, $cipher, $this->key, $options = OPENSSL_RAW_DATA, $iv);
    }
}
