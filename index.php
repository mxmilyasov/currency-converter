<?php declare(strict_types=1);

require_once 'vendor/autoload.php';

$db = \App\Database::getConnection();

$query = $db->query('SELECT name, age FROM test_table');

$result = $query->fetch(PDO::FETCH_ASSOC);

echo $result['name'] . ', ' . $result['age'];
