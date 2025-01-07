<?php
global $pdo;
include __DIR__  . '/../../db/connect.php';

$sql = 'SELECT * FROM `games`';
$sqlResult = $pdo->query($sql);

echo json_encode($sqlResult->fetchAll(PDO::FETCH_ASSOC), JSON_UNESCAPED_UNICODE);
