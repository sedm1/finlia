<?php

namespace Services\User\Methods;

require_once __DIR__ . '/../Mods/User.php';

use Methods;
use Services\User;

/**
 * Регистрация пользователя
 */
class Add extends Methods\AbstractMethod
{
    /**
     * Никнейм пользователя
     */
    public $nickname;

    /**
     * Email пользователя
     */
    public $email;

    /**
     * Пароль пользователя
     */
    public $password;

    public function exec()
    {
        $res = [];

        if (User\Mods\User::isUserExist($this->pdo, $this->nickname, $this->email)) {
            $res['errors']['text'] = 'Пользователь с такой почтой или с таким email уже существует';

            return $res;
        }

        $sql = "INSERT INTO `users` (`nickname`, `email`, `regdate`, `password`) VALUES (:nickname, :email, :regdate, :password)";
        $sth = $this->pdo->prepare($sql);
        $sqlResult = $sth->execute(['nickname' => $this->nickname, 'email' => $this->email, 'regdate' => time(), 'password' => md5(md5($this->password))]);

        if (!$sqlResult) {
            $res['errors']['text'] = 'Неудалось выполнить запрос, вернитесь позже';

            return $res;
        };

        $res['data']['text'] = 'Регистрация прошла успешно. Теперь вы можете войти в аккаунт';

        return $res;
    }
}


