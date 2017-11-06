<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 03/11/2017
 * Time: 04:34 PM
 */

namespace Greenter\Sunat\Controller;

use Greenter\Parser\DocumentParserInterface;
use Greenter\Sunat\Repository\XmlRepository;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class SaleController
 * @package Greenter\Sunat\Controller
 */
class SaleController
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
    public function invoice($request, $response, $args)
    {
        $ruc = $args['ruc'];
        /**@var $repo XmlRepository */
        $repo = $this->container->get('xml.repo');
        $files = array_merge($repo->getDocuments($ruc, 'FAC'), $repo->getDocuments($ruc, 'BOL'));

        return $this->withDocs($response, $this->container->get('parser.invoice'), $files);
    }

    /**
     * @param Request    $request
     * @param Response   $response
     * @param array $args
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function note($request, $response, $args)
    {
        $ruc = $args['ruc'];
        /**@var $repo XmlRepository */
        $repo = $this->container->get('xml.repo');
        $files = array_merge($repo->getDocuments($ruc, 'NCR'), $repo->getDocuments($ruc, 'NDB'));

        return $this->withDocs($response, $this->container->get('parser.note'), $files);
    }

    /**
     * @param Request    $request
     * @param Response   $response
     * @param array $args
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function rrhh($request, $response, $args)
    {
        $ruc = $args['ruc'];
        /**@var $repo XmlRepository */
        $repo = $this->container->get('xml.repo');
        $files = $repo->getDocuments($ruc, 'RRHH');

        return $this->withDocs($response, $this->container->get('parser.rrhh'), $files);
    }

    /**
     * @param Response $response
     * @param DocumentParserInterface $parser
     * @param array $files
     * @return Response
     */
    private function withDocs($response, $parser, array $files)
    {
        /**@var $serializer \Symfony\Component\Serializer\Serializer */
        $serializer = $this->container->get('serializer');
        $documents = [];
        foreach ($files as $file) {
            if($file == '.' || $file == '..') continue;

            $document = $parser->parse(file_get_contents($file));
            $documents[] = $document;
        }

        $json = $serializer->serialize($documents, 'json');
        $response->getBody()->write($json);

        return $response->withHeader('Content-Type', 'application/json; charset=utf8');
    }
}