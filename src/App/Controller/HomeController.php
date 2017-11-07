<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 06/11/2017
 * Time: 21:08
 */

namespace Greenter\Sunat\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class HomeController
 * @package Greenter\Sunat\Controller
 */
class HomeController
{
    /**
     * @param Request    $request
     * @param Response   $response
     * @param array $args
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index($request, $response, $args)
    {
        $swaggerUrl = $request->getUri() . 'swagger';
        $body = <<<HTML
<h1>Greenter APP</h1>
<a href="http://petstore.swagger.io/?url=$swaggerUrl">Swagger API Documentacion</a>
HTML;
        $response->getBody()->write($body);

        return $response;
    }

    /**
     * @param Request    $request
     * @param Response   $response
     * @param array $args
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function swagger($request, $response, $args)
    {
        $filename = __DIR__ . '/../../data/swagger.json';
        if (!file_exists($filename)) {
            return $response->withStatus(404);
        }
        $jsonContent = file_get_contents($filename);
        $response->getBody()->write(str_replace('greenter.api', $this->getBaseUri($request), $jsonContent));

        return $response->withHeader('Content-Type', 'application/json; charset=utf8');
    }

    /**
     * @param Request $request
     * @return string
     */
    private function getBaseUri($request)
    {
        $uri = $request->getUri();
        $url = $uri->getHost();
        if ($uri->getPort() && $uri->getPort() !== 80) {
            $url .= ':' . $uri->getPort();
        }

        return $url;
    }
}