<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 23/11/2017
 * Time: 10:10 AM
 */

namespace Greenter\Sunat\Controller;

use Doctrine\ORM\EntityManager;
use Greenter\Sunat\Entity\ProductCategory;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class CategoryController
 * @package Greenter\Sunat\Controller
 */
class CategoryController
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $manager)
    {
        $this->em = $manager;
    }

    /**
     * @param Request    $request
     * @param Response   $response
     * @param array $args
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getAll($request, $response, $args)
    {
        $jwt = $request->getAttribute("jwt");

        $repo = $this->getRepository();
        $items = $repo->findBy(['userId' => $jwt->id]);
        $all = [];

        foreach ($items as $item) {
            /**@var $item ProductCategory */
            $all[] = [
                'id' => $item->getId(),
                'code' => $item->getCode(),
                'description' => $item->getDescription(),
            ];
        }

        return $response->withJson($all);
    }

    /**
     * @param Request    $request
     * @param Response   $response
     * @param array $args
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get($request, $response, $args)
    {
        $id = $args['id'];
        $jwt = $request->getAttribute("jwt");

        $repo = $this->getRepository();
        /**@var $item ProductCategory */
        $item = $repo->findBy(['userId' => $jwt->id, 'id' => $id]);

        if (empty($item)) {
            return $response->withStatus(404);
        }

        return $response->withJson([
            'id' => $item->getId(),
            'code' => $item->getCode(),
            'description' => $item->getDescription(),
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
        $obj = $request->getParsedBody();
        $jwt = $request->getAttribute("jwt");
        $category = new ProductCategory();
        $category->setUserId($jwt->id)
            ->setCode($obj['code'])
            ->setDescription($obj['description']);

        $this->em->persist($category);

        return $response;
    }

    /**
     * @param Request    $request
     * @param Response   $response
     * @param array $args
     * @return \Psr\Http\Message\ResponseInterface
     * @throws
     */
    public function put($request, $response, $args)
    {
        $obj = $request->getParsedBody();
        $jwt = $request->getAttribute("jwt");

        $repo = $this->getRepository();
        $category = $repo->findOneBy(['userId' => $jwt->id, 'id' => intval($obj['id'])]);
        if (empty($category)) {
            return $response->withStatus(404);
        }

        $category->setCode($obj['code'])
                ->setDescription($obj['description']);

        $this->em->flush();

        return $response;
    }

    /**
     * @param Request    $request
     * @param Response   $response
     * @param array $args
     * @return \Psr\Http\Message\ResponseInterface
     * @throws
     */
    public function delete($request, $response, $args)
    {
        $id = $args['id'];
        $jwt = $request->getAttribute("jwt");

        $repo = $this->getRepository();
        $category = $repo->findOneBy(['userId' => $jwt->id, 'id' => $id]);
        if (empty($category)) {
            return $response->withStatus(404);
        }
        $this->em->remove($category);
        $this->em->flush();

        return $response;
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    private function getRepository()
    {
        return $this->em->getRepository(ProductCategory::class);
    }
}