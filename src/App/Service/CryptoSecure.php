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
     * @param string $data
     * @param string $key
     * @return string
     */
    public function encrypt($data, $key)
    {
        $output = openssl_encrypt($data, self::METHOD, $key, 0, self::IV);
        $output = base64_encode($output);

        return $output;
    }

    /**
     * @param string $data
     * @param string $key
     * @return string|bool
     */
    public function decrypt($data, $key)
    {
        return openssl_decrypt(base64_decode($data), self::METHOD, $key, 0, self::IV);
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