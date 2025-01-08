<?php

namespace Services\User\Methods;

require_once __DIR__ . '/../Mods/User.php';

use PDO;
use Services\User;
use Methods;

/**
 * Войти в аккаунт
 */
class Get extends Methods\AbstractMethod
{
    /**
     * Никнейм пользователя
     */
    public string $nickname;

    /**
     * Пароль пользователя
     */
    public string $password;

    public function exec(): array
    {
        $res = [];

        if (!User\Mods\User::isUserExist($this->pdo, $this->nickname, '')) {
            $res['errors']['text'] = 'Такого пользователя не существует. Создайте аккаунт';
            return $res;
        }

        $sql = "SELECT md5(md5(`id`)) as `hash` FROM `users` WHERE `nickname` = :nickname AND `password` = :password";
        $sth = $this->pdo->prepare($sql);
        $sth->execute([':nickname' => $this->nickname, ':password' => md5(md5($this->password))]);
        $sqlRes = $sth->fetch(PDO::FETCH_COLUMN);

        if (!$sqlRes) {
            $res['errors']['text'] = 'Неудалось войти в аккаунт.';
            return $res;
        }

        $res['data']['text'] = 'Вход выполнен успешно';
        $res['data']['hash'] = $sqlRes;
        $res['data']['nickname'] = $this->nickname;

        return $res;
    }
}
