<?php

namespace infrastructure\utils;

use Exception;
use mysqli;

abstract class Db
{
    private const ID_BINARY_LENGTH = 16;
    private static mysqli $mysqli;

    public static function init() {
        $config = require 'application/config/dbconfig.php';
        self::$mysqli = new mysqli($config['hostname'], $config['username'], $config['password'], $config['database']);
    }

    public static function query($query) : bool {
        return self::$mysqli->query($query);
    }

    public static function queryFetch($query) : array {
        $result = self::$mysqli->query($query);
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            array_push($rows, $row);
        }
        return $rows;
    }

    public static function queryFetchSingle($query) : array {
        $result = self::queryFetch($query);
        if (count($result) == 0) {
            return [];
        }
        return $result[0];
    }

    public static function createNewToken() : string {
        try {
            return bin2hex(random_bytes(self::ID_BINARY_LENGTH));
        } catch(Exception) {
            die('Ошибка при генерации id');
        }
    }
}