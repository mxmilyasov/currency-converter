<?php

namespace App;

use PDO;

class Database
{

    public static function getConnection(): PDO
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        $host = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASS'];

        $dsn = "mysql:host=$host;dbname=$dbname";
        $db = new PDO($dsn, $user, $password);

        $db->exec("set names utf8");

        return $db;
    }
}
