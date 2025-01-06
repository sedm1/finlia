<?php
$host = 'f1071715.xsph.ru';
$dbname = 'f1071715_finlia';
$name = 'f1071715_finlia';
$pass = 'Kolo135790';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Headers: *');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;", $name, $pass);
} catch (PDOException $exception) {
    var_dump($exception->getMessage());
}
