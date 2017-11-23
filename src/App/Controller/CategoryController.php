<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 23/11/2017
 * Time: 10:10 AM
 */

namespace Greenter\Sunat\Controller;

use Greenter\Sunat\Model\ProductCategory;
use Greenter\Sunat\Repository\ProductCategoryRepository;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class CategoryController
 * @package Greenter\Sunat\Controller
 */
class CategoryController
{
    /**
     * @var ProductCategoryRepository
     */
    private $repository;

    public function __construct(ProductCategoryRepository $repository)
    {
        $this->repository = $repository;
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

        $items = $this->repository->getAll($jwt->id);
        $all = [];

        foreach ($items as $item) {
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

        $item = $this->repository->get($id, $jwt->id);

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

        $success = $this->repository->add($category);

        if (!$success) {
            return $response->withStatus(400);
        }

        return $response;
    }

    /**
     * @param Request    $request
     * @param Response   $response
     * @param array $args
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function put($request, $response, $args)
    {
        $obj = $request->getParsedBody();
        $jwt = $request->getAttribute("jwt");
        $category = new ProductCategory();
        $category->setUserId($jwt->id)
            ->setCode($obj['code'])
            ->setDescription($obj['description'])
            ->setId(intval($obj['id']));

        $success = $this->repository->update($category);

        if (!$success) {
            return $response->withStatus(400);
        }

        return $response;
    }

    /**
     * @param Request    $request
     * @param Response   $response
     * @param array $args
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function delete($request, $response, $args)
    {
        $id = $args['id'];
        $jwt = $request->getAttribute("jwt");

        $success = $this->repository->delete($id, $jwt->id);

        if (!$success) {
            return $response->withStatus(400);
        }

        return $response;
    }
}