<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 09/11/2017
 * Time: 00:00
 */

namespace Greenter\Sunat\Model;

/**
 * Class Profile
 * @package Greenter\Sunat\Model
 */
class Profile
{
    /**
     * @var string
     */
    private $ruc;

    /**
     * @var string
     */
    private $razonSocial;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var int
     */
    private $userId;

    /**
     * @return string
     */
    public function getRuc()
    {
        return $this->ruc;
    }

    /**
     * @param string $ruc
     * @return Profile
     */
    public function setRuc($ruc)
    {
        $this->ruc = $ruc;
        return $this;
    }

    /**
     * @return string
     */
    public function getRazonSocial()
    {
        return $this->razonSocial;
    }

    /**
     * @param string $razonSocial
     * @return Profile
     */
    public function setRazonSocial($razonSocial)
    {
        $this->razonSocial = $razonSocial;
        return $this;
    }

    /**
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param string $direccion
     * @return Profile
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return Profile
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }
}