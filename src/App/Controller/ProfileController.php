<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 09/11/2017
 * Time: 04:14 PM
 */

namespace Greenter\Sunat\Controller;

use Doctrine\ORM\EntityManager;
use Greenter\Sunat\Entity\Profile;
use Greenter\Sunat\Service\CryptoSecure;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class ProfileController
 * @package Greenter\Sunat\Controller
 */
class ProfileController
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * SaleController constructor.
     * @param ContainerInterface $container
     * @throws
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->em = $container->get('em');
    }

    /**
     * @param Request    $request
     * @param Response   $response
     * @param array $args
     * @return \Psr\Http\Message\ResponseInterface
     * @throws
     */
    public function get($request, $response, $args)
    {
        $jwt = $request->getAttribute("jwt");

        $profile = $this->em->find(Profile::class, $jwt->id);
        if (empty($profile)) {
            return $response->withStatus(404);
        }

        return $response->withJson([
            'ruc' => $profile->getRuc(),
            'razon_social' => $profile->getRazonSocial(),
            'direccion' => $profile->getDireccion(),
            'user_sol' => $profile->getUserSol(),
            'clave_sol' => null
        ]);
    }

    /**
     * @param Request    $request
     * @param Response   $response
     * @param array $args
     * @return \Psr\Http\Message\ResponseInterface
     * @throws
     */
    public function post($request, $response, $args)
    {
        $jwt = $request->getAttribute("jwt");
        $json = $request->getParsedBody();
        $profile = new Profile();
        $profile->setRuc($json['ruc'])
            ->setRazonSocial($json['razon_social'])
            ->setDireccion($json['direccion'])
            ->setUserSol($json['user_sol'])
            ->setClaveSol($json['clave_sol'])
            ->setUserId($jwt->id);

        if ($profile->getClaveSol()) {
            /**@var $crypt CryptoSecure */
            $crypt = $this->container->get('service.crypto');
            $profile->setClaveSol($crypt->encrypt($profile->getClaveSol()));
        }

        $this->em->persist($profile);
        $this->em->flush();

        return $response;
    }
}