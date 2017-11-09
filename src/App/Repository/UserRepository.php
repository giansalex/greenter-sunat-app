<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 08/11/2017
 * Time: 23:57
 */

namespace Greenter\Sunat\Repository;

use Greenter\Sunat\Model\User;

/**
 * Class UserRepository
 * @package Greenter\Sunat\Repository
 */
class UserRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * UserRepository constructor.
     * @param DbConnection $dbConnection
     */
    public function __construct(DbConnection $dbConnection)
    {
        $this->connection = $dbConnection->createConnection();
    }

    public function add(User $user)
    {
        $params = [
            $user->getEmail(),
            $user->getPassword()
        ];
        $con = $this->connection;
        $stm = $con->prepare('INSERT INTO usuario(email, password) VALUES (?, ?)');
        $stm->execute($params);
        $id = $con->lastInsertId();
        $con->exec("INSERT INTO perfil(user_id) VALUES($id)");
        $user->setId($id);

        return $user;
    }

    /**
     * @param string $email
     * @return bool
     */
    public function exist($email)
    {
        $con = $this->connection;
        $stm = $con->prepare('SELECT COUNT(id) FROM usuario WHERE email = ?');
        $stm->execute([$email]);
        $count = $stm->fetchColumn();
        return $count > 0;
    }

    /**
     * @param $email
     * @param $password
     * @return bool|User
     */
    public function get($email, $password)
    {
        $con = $this->connection;
        $stm = $con->prepare('SELECT id, email, password FROM usuario WHERE email=?');
        $stm->execute([$email]);
        /**@var $obj User */
        $obj = $stm->fetchObject(User::class);
        if ($obj === FALSE) {
            return FALSE;
        }
        if (password_verify($password, $obj->getPassword())) {
            return $obj;
        }
        return FALSE;
    }
}