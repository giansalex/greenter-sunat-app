<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 09/11/2017
 * Time: 00:05
 */

namespace Greenter\Sunat\Repository;

use Doctrine\ORM\EntityManager;
use Greenter\Sunat\Entity\Profile;
use Greenter\Sunat\Service\CryptoSecure;
use Psr\Container\ContainerInterface;

/**
 * Class ProfileRepository
 * @package Greenter\Sunat\Repository
 */
class ProfileRepository
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * ProfileRepository constructor.
     * @param ContainerInterface $container
     * @throws
     */
    public function __construct(ContainerInterface $container)
    {
        $this->em = $container->get('em');
        $this->container = $container;
    }

    /**
     * @param int $userId
     * @return Profile
     * @throws
     */
    public function get($userId)
    {
        $repo = $this->em->getRepository(Profile::class);
        /**@var $profile Profile*/
        $profile = $repo->find($userId);

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
     * @throws
     */
    public function save(Profile $profile)
    {
        if ($profile->getClaveSol()) {
            /**@var $crypt CryptoSecure */
            $crypt = $this->container->get('service.crypto');
            $profile->setClaveSol($crypt->encrypt($profile->getClaveSol(),
                $this->container->get('settings')['crypto_key']));
        }

        $this->em->persist($profile);
        $this->em->flush();
    }
}