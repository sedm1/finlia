<?php

namespace Services\User\Mods;

use PDO;

class User {
    /**
     * Существует ли пользователь
     */
    public static function isUserExist($pdo, $nickname, $email) {
        $sql = "SELECT COUNT(`id`) as usersCount FROM `users` WHERE `nickname` = :nickname OR `email` = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["nickname" => $nickname, "email" => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC)['usersCount'] > 0;
    }
}
