<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 08/11/2017
 * Time: 23:58
 */

namespace Greenter\Sunat\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @ORM\Entity(repositoryClass="Greenter\Sunat\Repository\UserRepository")
 * @ORM\Table(name="usuario")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;
    /**
     * @ORM\Column(name="email", type="string", length=100)
     * @var string
     */
    private $email;
    /**
     * @ORM\Column(name="password", type="string", length=120)
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