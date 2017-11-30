<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 08/11/2017
 * Time: 23:57
 */

namespace Greenter\Sunat\Repository;

use Doctrine\ORM\EntityRepository;
use Greenter\Sunat\Entity\User;

/**
 * Class UserRepository
 * @package Greenter\Sunat\Repository
 */
class UserRepository extends EntityRepository
{
    /**
     * @param string $email
     * @return bool
     * @throws
     */
    public function exist($email)
    {
        $count = $this->createQueryBuilder('c')
            ->select('COUNT(c)')
            ->where('c.email = ?1')
            ->setParameter(1, $email)
            ->getQuery()
            ->getSingleScalarResult();

        return $count > 0;
    }

    /**
     * @param $email
     * @param $password
     * @return bool|User
     */
    public function get($email, $password)
    {
        $user = $this->findOneBy(['email' => $email]);
        if (empty($user)) {
            return FALSE;
        }

        if (password_verify($password, $user->getPassword())) {
            return $user;
        }

        return FALSE;
    }
}