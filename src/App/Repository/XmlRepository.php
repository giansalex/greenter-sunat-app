<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 06/11/2017
 * Time: 04:02 PM
 */

namespace Greenter\Sunat\Repository;

/**
 * Class XmlRepository
 * @package Greenter\Sunat\Repository
 */
class XmlRepository
{
    /**
     * @var string
     */
    private $directPath;

    /**
     * XmlRepository constructor.
     * @param string $directPath
     */
    public function __construct($directPath)
    {
        $this->directPath = $directPath;
    }

    /**
     * @param string $ruc
     * @param string $tipo
     * @return array
     */
    public function getDocuments($ruc, $tipo)
    {
        $files = glob($this->directPath . DIRECTORY_SEPARATOR . $tipo . DIRECTORY_SEPARATOR . '*.xml');

        return $files;
    }
}