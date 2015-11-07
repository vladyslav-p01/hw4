<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 31.10.15
 * Time: 16:02
 */

namespace Layer\Connector;

use PDO;

class ConnectDb implements ConnectorInterface
{

    private $pdo = null;

    public function __construct(array $paramDb)
    {
        $dsn = $paramDb['type'] . ":host=" . $paramDb['host'] . ";";
        $dsn .= "dbname=" . $paramDb['db'] . ";";
        $dsn .= "charset=" . $paramDb['charset'];
        $opt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        $pdo = new PDO($dsn, $paramDb['user'], $paramDb['password']);
        $this->pdo = $pdo;
    }

    /**
     * @return null|PDO
     */
    public function connect()
    {
        return $this->pdo;
    }



    /**
     * @param $db
     * @return mixed
     */
    public function connectClose()
    {
        if ($this->pdo !== null) {
            unset($this->pdo);
            return true;
        }
        return false;
    }
}