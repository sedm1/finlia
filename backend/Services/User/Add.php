<?php

namespace Services\User;

use PDO;
use Methods;

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

        if ($this->checkUserExist()) {
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

    protected function checkUserExist()
    {
        $sql = "SELECT COUNT(`id`) as usersCount FROM `users` WHERE `nickname` = :nickname OR `email` = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["nickname" => $this->nickname, "email" => $this->email]);


        return $stmt->fetch(PDO::FETCH_ASSOC)['usersCount'] > 0;
    }
}


