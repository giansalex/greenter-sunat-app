<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 09/11/2017
 * Time: 00:05
 */

namespace Greenter\Sunat\Repository;

use Greenter\Sunat\Model\Profile;

/**
 * Class ProfileRepository
 * @package Greenter\Sunat\Repository
 */
class ProfileRepository
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

    /**
     * @param int $userId
     * @return Profile
     */
    public function get($userId)
    {
        $con = $this->connection;
        $res = $con->query('SELECT ruc, razon_social AS razonSocial, direccion, user_id FROM perfil WHERE user_id = ' . $userId);

        /**@var $profile Profile*/
        $profile = $res->fetchObject(Profile::class);

        return $profile;
    }

    /**
     * @param Profile $profile
     */
    public function save(Profile $profile)
    {
        $con = $this->connection;
        $stm = $con->prepare('UPDATE perfil SET ruc = ?, razon_social = ?, direccion=? WHERE user_id = ?');
        $stm->execute([
            $profile->getRuc(),
            $profile->getRazonSocial(),
            $profile->getDireccion(),
            $profile->getUserId(),
        ]);
    }
}