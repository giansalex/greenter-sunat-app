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
     * @var string
     */
    private $dsn;
    /**
     * @var string
     */
    private $user;
    /**
     * @var string
     */
    private $pass;
    /**
     * DbConnection constructor.
     * @param string $dsn
     * @param string $user
     * @param string $pass
     */
    public function __construct($dsn, $user, $pass)
    {
        $this->dsn = $dsn;
        $this->user = $user;
        $this->pass = $pass;
    }
    /**
     * @return \PDO
     */
    public function createConnection()
    {
        return new \PDO($this->dsn, $this->user,$this->pass);
    }
}