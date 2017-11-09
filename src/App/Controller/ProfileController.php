<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 09/11/2017
 * Time: 04:14 PM
 */

namespace Greenter\Sunat\Controller;

use Greenter\Sunat\Model\Profile;
use Greenter\Sunat\Repository\ProfileRepository;
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
     * SaleController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param Request    $request
     * @param Response   $response
     * @param array $args
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get($request, $response, $args)
    {
        $jwt = $request->getAttribute("jwt");
        /**@var $repo ProfileRepository */
        $repo = $this->container->get('repository.profile');

        $profile = $repo->get($jwt->id);

        return $response->withJson([
            'ruc' => $profile->getRuc(),
            'razon_social' => $profile->getRazonSocial(),
            'direccion' => $profile->getDireccion(),
        ]);
    }

    /**
     * @param Request    $request
     * @param Response   $response
     * @param array $args
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function post($request, $response, $args)
    {
        $jwt = $request->getAttribute("jwt");
        $json = $request->getParsedBody();
        $profile = new Profile();
        $profile->setRuc($json['ruc'])
            ->setRazonSocial($json['razon_social'])
            ->setDireccion($json['direccion'])
            ->setUserId($jwt->id);

        /**@var $repo ProfileRepository */
        $repo = $this->container->get('repository.profile');
        $repo->save($profile);

        return $response;
    }
}