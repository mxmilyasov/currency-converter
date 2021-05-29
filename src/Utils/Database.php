<?php

namespace Mxmilyasov\Converter\Utils;

use PDO;

class Database
{

    public static function getConnection(): PDO
    {
        $host = $_SERVER['DB_HOST'];
        $dbname = $_SERVER['DB_NAME'];
        $user = $_SERVER['DB_USER'];
        $password = $_SERVER['DB_PASS'];

        $dsn = "mysql:host=$host;dbname=$dbname";
        $db = new PDO($dsn, $user, $password);

        $db->exec("set names utf8");

        return $db;
    }
}
