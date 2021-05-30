<?php

use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Dotenv\Dotenv;

require_once APP_ROOT . "/vendor/autoload.php";

$isDevMode = true;

$config = Setup::createAnnotationMetadataConfiguration(
    [APP_ROOT . '/src/Model'],
    $isDevMode,
    null,
    null,
    false
);

$dotEnv = Dotenv::createImmutable(APP_ROOT);
$dotEnv->load();

$connection = [
    'dbname' => $_SERVER['DB_NAME'],
    'user' => $_SERVER['DB_USER'],
    'password' => $_SERVER['DB_PASS'],
    'host' => $_SERVER['DB_HOST'],
    'driver' => 'pdo_mysql'
];

try {
    $em = EntityManager::create($connection, $config);
} catch (ORMException $e) {
    dump('An error occurred while trying to connect!');
}
