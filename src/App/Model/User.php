<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 08/11/2017
 * Time: 23:58
 */

namespace Greenter\Sunat\Model;

/**
 * Class User
 * @package Greenter\Sunat\Model
 */
class User
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param int $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    /**
     * @param $password
     * @return $this
     */
    public function setPlainPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        return $this;
    }
}