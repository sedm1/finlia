<?php

namespace Services\User\Methods;

require_once __DIR__ . '/../Mods/User.php';

use Services\User;
use Methods;

/**
 * Войти в аккаунт
 */
class Get extends Methods\AbstractMethod {
    /**
     * Никнейм пользователя
     */
    public string $nickname;

    /**
     * Пароль пользователя
     */
    public string $password;

    protected function exec(): array {
        $res = [];

        if(!User\Mods\User::isUserExist($this->pdo, $this->nickname, '')) echo $res['errors']['text'] = 'Такого пользователя не существует. Слздайте аккаунт'
    }
}
