<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 16/11/2017
 * Time: 22:48
 */

namespace Greenter\Sunat\Controller;

use Peru\Sunat\Ruc;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class ConsultController
 * @package Greenter\Sunat\Controller
 */
class ConsultController
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
    public function ruc($request, $response, $args)
    {
        $ruc = $args["ruc"];
        /**@var $service Ruc */
        $service = $this->container->get('consult.ruc');
        $company = $service->get($ruc);
        if ($company === false) {
            $response->getBody()->write($service->getError());
            return $response->withStatus(404);
        }

        return json_encode(get_object_vars($company));
    }
}