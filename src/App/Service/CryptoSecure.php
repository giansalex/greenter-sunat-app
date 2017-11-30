<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 23/11/2017
 * Time: 09:41 AM
 */

namespace Greenter\Sunat\Service;

/**
 * Class CryptoSecure
 */
class CryptoSecure
{
    const IV = '4663d6c43g9176bu';
    const METHOD = 'AES-256-CBC';
    /**
     * @var string
     */
    private $key;

    /**
     * CryptoSecure constructor.
     * @param $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }


    /**
     * @param string $data
     * @return string
     */
    public function encrypt($data)
    {
        $output = openssl_encrypt($data, self::METHOD, $this->key, 0, self::IV);
        $output = base64_encode($output);

        return $output;
    }

    /**
     * @param string $data
     * @return string|bool
     */
    public function decrypt($data)
    {
        return openssl_decrypt(base64_decode($data), self::METHOD, $this->key, 0, self::IV);
    }

    /**
     * Get Hash from secure key.
     *
     * @param string $secretKey
     * @return string
     */
    public function getHash($secretKey)
    {
        return hash('sha256', $secretKey);
    }
}