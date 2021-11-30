<?php

namespace application\services;

use infrastructure\utils\Db;

abstract class AdminService
{
    private const sessionKey = 'ADMIN_LOGIN';

    public static function login(string $login, string $password) : bool {
        $safeLogin = htmlspecialchars($login);
        $admins = Db::queryFetch("SELECT * FROM admins WHERE login='$login'");
        if (count($admins) == 0) {
            return false;
        }
        $passwordHash = $admins[0]['password'];
        if (!password_verify($password, $passwordHash)) {
            return false;
        }
        self::authorizeAdmin($safeLogin);
        return true;
    }

    public static function register(string $login, $password) : bool {
        $safeLogin = htmlspecialchars($login);
        if (self::isAdminExists($safeLogin)) {
            return false;
        }

        $newId = Db::createNewToken();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        Db::query("INSERT INTO admins (id, login, password) VALUES ($newId, $safeLogin, $hashedPassword)");
        return true;
    }

    private static function isAdminExists(string $login) : bool {
        $login = htmlspecialchars($login);
        $logins = Db::queryFetch("SELECT `login` FROM admins WHERE login='$login'");
        return count($logins) > 0;
    }

    public static function authorizeAdmin($login) {
        $_SESSION[self::sessionKey] = $login;
    }

    public static function isAdminAuthorized() {
        return isset($_SESSION[self::sessionKey]);
    }

    public static function logout() {
        unset($_SESSION[self::sessionKey]);
    }
}