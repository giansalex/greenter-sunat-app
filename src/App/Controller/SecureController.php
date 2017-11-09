<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 08/11/2017
 * Time: 23:23
 */

namespace Greenter\Sunat\Controller;

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
     * @var ContainerInterface
     */
    private $container;

    /**
     * SecureController constructor.
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
    public function login($request, $response, $args)
    {

        return $response;
    }

    /**
     * @param Request    $request
     * @param Response   $response
     * @param array $args
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function register($request, $response, $args)
    {

        return $response;
    }
}