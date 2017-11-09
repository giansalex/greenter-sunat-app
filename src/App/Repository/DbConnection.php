<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 08/11/2017
 * Time: 23:57
 */

namespace Greenter\Sunat\Repository;

/**
 * Class DbConnection
 * @package Greenter\Sunat\Repository
 */
class DbConnection
{
    /**
     * @var array
     */
    private $params;

    /**
     * DbConnection constructor.
     * @param array $params
     */
    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * @return \PDO
     */
    public function createConnection()
    {
        $args = $this->params;
        return new \PDO($args['dsn'], $args['user'], $args['pass']);
    }
}