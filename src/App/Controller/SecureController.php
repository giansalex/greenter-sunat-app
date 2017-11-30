<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 08/11/2017
 * Time: 23:23
 */

namespace Greenter\Sunat\Controller;

use Doctrine\ORM\EntityManager;
use Firebase\JWT\JWT;
use Greenter\Sunat\Entity\User;
use Greenter\Sunat\Repository\UserRepository;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class SecureController
 * @package Greenter\Sunat\Controller
 */
class SecureController
{
    /**
     * @var string
     */
    private $secret;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * SecureController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->secret = $container['settings']['jwt']['secret'];
        $this->container = $container;
    }

    /**
     * @param Request    $request
     * @param Response   $response
     * @param array $args
     * @return \Psr\Http\Message\ResponseInterface
     * @throws
     */
    public function login($request, $response, $args)
    {
        $params = $request->getParsedBody();

        $res = $this->container->get('service.validator')->login($params);
        if ($res['success'] === false) {
            return $response->withJson(['message' => $res['message']], 400);
        }

        /**@var $em EntityManager */
        $em = $this->container->get('em');
        /**@var $repo UserRepository */
        $repo = $em->getRepository(User::class);

        $user = $repo->get($params['email'], $params['password']);

        if ($user === false) {
            return $response->withJson(['message' => 'credenciales inválidas'], 400);
        }

        return $this->withTokenById($response, $user->getId());
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return \Psr\Http\Message\ResponseInterface
     * @throws
     */
    public function register($request, $response, $args)
    {
        $params = $request->getParsedBody();

        $res = $this->container->get('service.validator')->register($params);
        if ($res['success'] === false) {
            return $response->withJson(['message' => $res['message']], 400);
        }

        /**@var $em EntityManager */
        $em = $this->container->get('em');
        /**@var $repo UserRepository */
        $repo = $em->getRepository(User::class);

        if ($repo->exist($params['email'])) {
            return $response->withJson(['message' => 'email ya registrado'], 400);
        }

        $user = new User();
        $user->setEmail($params['email'])
            ->setPlainPassword($params['password']);

        $em->persist($user);
        $em->flush();

        return $this->withTokenById($response, $user->getId());
    }

    /**
     * @param Response $response
     * @param int $id
     * @return Response
     */
    private function withTokenById($response, $id)
    {
        $data = [
            'id' => $id,
            'nbf' => time(),
        ];
        $token = JWT::encode($data, $this->secret);

        return $response->withJson(['token' => $token], 200);
    }
}