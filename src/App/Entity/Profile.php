<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 09/11/2017
 * Time: 00:00
 */

namespace Greenter\Sunat\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Profile
 * @ORM\Entity
 * @ORM\Table(name="perfil")
 */
class Profile
{
    /**
     * @ORM\Column(name="ruc", type="string", length=11)
     * @var string
     */
    private $ruc;

    /**
     * @ORM\Column(name="razon_social", type="string", length=200)
     * @var string
     */
    private $razonSocial;

    /**
     * @ORM\Column(name="direccion", type="string", length=200)
     * @var string
     */
    private $direccion;

    /**
     * @ORM\Column(name="user_sol", type="string", length=20)
     * @var string
     */
    private $userSol;

    /**
     * @ORM\Column(name="clave_sol", type="string", length=30)
     * @var string
     */
    private $claveSol;

    /**
     * @ORM\Id()
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @var int
     */
    private $userId;

    /**
     * @ORM\OneToOne(targetEntity="User", fetch="LAZY")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @var User
     */
    private $user;

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
     * @return string
     */
    public function getUserSol()
    {
        return $this->userSol;
    }

    /**
     * @param string $userSol
     * @return Profile
     */
    public function setUserSol($userSol)
    {
        $this->userSol = $userSol;
        return $this;
    }

    /**
     * @return string
     */
    public function getClaveSol()
    {
        return $this->claveSol;
    }

    /**
     * @param string $claveSol
     * @return Profile
     */
    public function setClaveSol($claveSol)
    {
        $this->claveSol = $claveSol;
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

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Profile
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
}