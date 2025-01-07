<?php
/**
 * Регистрация пользователя
 */

global $pdo;
global $data;
include __DIR__ . '/../../db/connect.php';

$res = [];

$nickname = $data["nickname"];
$email = $data["email"];
$password = $data["password"];

/**
 * Проверка на существование пользователя по никнейму и почте
 */
function checkUserExist($nickname, $email)
{
    global $pdo;

    $sql = "SELECT COUNT(`id`) as usersCount FROM `users` WHERE `nickname` = :nickname OR `email` = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["nickname" => $nickname, "email" => $email]);


    return $stmt->fetch(PDO::FETCH_ASSOC)['usersCount'] > 0;
}

if (checkUserExist($nickname, $email)) {
    $res['errors']['text'] = 'Пользователь с такой почтой или с таким email уже существует';

    echo json_encode($res, JSON_UNESCAPED_UNICODE);
    return;
}

$sql = "INSERT INTO `users` (`nickname`, `email`, `regdate`, `password`) VALUES (:nickname, :email, :regdate, :password)";
$sth = $pdo->prepare($sql);
$sqlResult = $sth->execute(['nickname' => $nickname, 'email' => $email, 'regdate' => time(), 'password' => md5(md5($password))]);

if (!$sqlResult) {
    $res['errors']['text'] = 'Неудалось выполнить запрос, вернитесь позже';

    echo json_encode($res, JSON_UNESCAPED_UNICODE);
    return;
};

$res['data']['text'] = 'Регистрация прошла успешно. Теперь вы можете войти в аккаунт';
echo json_encode($res, JSON_UNESCAPED_UNICODE);
