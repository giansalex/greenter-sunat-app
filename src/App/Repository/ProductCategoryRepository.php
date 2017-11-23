<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 23/11/2017
 * Time: 09:30 AM
 */

namespace Greenter\Sunat\Repository;
use Greenter\Sunat\Model\ProductCategory;

/**
 * Class ProductCategoryRepository
 * @package Greenter\Sunat\Repository
 */
class ProductCategoryRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * UserRepository constructor.
     * @param DbConnection $dbConnection
     */
    public function __construct(DbConnection $dbConnection)
    {
        $this->connection = $dbConnection->createConnection();
    }

    /**
     * @param int $userId
     * @return ProductCategory[]
     */
    public function getAll($userId)
    {
        $con = $this->connection;
        $res = $con->query('SELECT id, code, description, user_Id FROM product_category WHERE user_id = ' . $userId);

        /**@var $profile ProductCategory*/
        $all = $res->fetchAll(\PDO::FETCH_CLASS, ProductCategory::class);

        return $all;
    }

    /**
     * @param int $id
     * @param int $userId
     * @return ProductCategory
     */
    public function get($id, $userId)
    {
        $con = $this->connection;
        $stm = $con->prepare('SELECT id, code, description, user_Id AS userId FROM product_category WHERE user_id = ? AND id = ?');
        $stm->execute([$userId, $id]);

        /**@var $category ProductCategory*/
        $category = $stm->fetchObject(ProductCategory::class);

        return $category;
    }

    /**
     * @param ProductCategory $category
     * @return bool
     */
    public function add(ProductCategory $category)
    {
        $con = $this->connection;
        $stm = $con->prepare('INSERT INTO product_category(code, description, user_Id) VALUES (?,?,?)');
        $res = $stm->execute([
            $category->getCode(),
            $category->getDescription(),
            $category->getUserId(),
        ]);

        return $res;
    }

    /**
     * @param ProductCategory $category
     * @return bool
     */
    public function update(ProductCategory $category)
    {
        $con = $this->connection;
        $stm = $con->prepare('UPDATE product_category SET code = ?, description = ? WHERE user_id = ? AND id = ?');
        $res = $stm->execute([
            $category->getCode(),
            $category->getDescription(),
            $category->getUserId(),
            $category->getId(),
        ]);

        return $res;
    }

    /**
     * @param int $id
     * @param int $userId
     * @return bool
     */
    public function delete($id, $userId)
    {
        $con = $this->connection;
        $stm = $con->prepare('DELETE FROM product_category WHERE user_id = ? AND id = ?');
        $res = $stm->execute([$userId, $id]);

        return $res;
    }
}