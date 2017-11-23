<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 09/11/2017
 * Time: 00:05
 */

namespace Greenter\Sunat\Repository;

use Greenter\Sunat\Model\Profile;
use Greenter\Sunat\Service\CryptoSecure;
use Psr\Container\ContainerInterface;

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
     * @var ContainerInterface
     */
    private $container;

    /**
     * ProfileRepository constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->connection = $container->get('repository.db')->createConnection();
        $this->container = $container;
    }

    /**
     * @param int $userId
     * @return Profile
     */
    public function get($userId)
    {
        $con = $this->connection;
        $res = $con->query('SELECT ruc, user_sol AS userSol, clave_sol AS claveSol, razon_social AS razonSocial, direccion, user_id FROM perfil WHERE user_id = ' . $userId);

        /**@var $profile Profile*/
        $profile = $res->fetchObject(Profile::class);

        if ($profile && $profile->getClaveSol()) {
            /**@var $crypt CryptoSecure */
            $crypt = $this->container->get('service.crypto');
            $profile->setClaveSol($crypt->decrypt($profile->getClaveSol(),
                $this->container->get('settings')['crypto_key']));
        }

        return $profile;
    }

    /**
     * @param Profile $profile
     */
    public function save(Profile $profile)
    {
        if ($profile->getClaveSol()) {
            /**@var $crypt CryptoSecure */
            $crypt = $this->container->get('service.crypto');
            $profile->setClaveSol($crypt->encrypt($profile->getClaveSol(),
                $this->container->get('settings')['crypto_key']));
        }

        $con = $this->connection;
        $stm = $con->prepare('UPDATE perfil SET ruc = ?, razon_social = ?, direccion=?, user_sol=?, clave_sol = ? WHERE user_id = ?');
        $stm->execute([
            $profile->getRuc(),
            $profile->getRazonSocial(),
            $profile->getDireccion(),
            $profile->getUserSol(),
            $profile->getClaveSol(),
            $profile->getUserId(),
        ]);
    }
}