<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 23/11/2017
 * Time: 09:27 AM
 */

namespace Greenter\Sunat\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ProductCategory
 * @ORM\Entity()
 * @ORM\Table(name="product_category")
 */
class ProductCategory
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;
    /**
     * @ORM\Column(name="code", type="string", length=20)
     * @var string
     */
    private $code;
    /**
     * @ORM\Column(name="description", type="string", length=50)
     * @var string
     */
    private $description;
    /**
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @var int
     */
    private $userId;

    /**
     * @ORM\ManyToOne(targetEntity="User", fetch="LAZY")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @var User
     */
    private $user;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ProductCategory
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return ProductCategory
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return ProductCategory
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * @return ProductCategory
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
     * @return ProductCategory
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
}