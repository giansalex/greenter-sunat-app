<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 03/11/2017
 * Time: 04:34 PM
 */

namespace Greenter\Sunat;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class SaleController
 * @package Greenter\Sunat
 */
class SaleController
{
    /**
     * @param Request    $request
     * @param Response   $response
     * @param array $args
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index($request, $response, $args)
    {
        return $response;
    }
}