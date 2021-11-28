<?php

namespace infrastructure\utils;

use infrastructure\types\HttpCode;

class HttpUtils
{
    public static function toHttpMessage(int $httpCode): string {
        return match ($httpCode) {
            HttpCode::Status403 => "Ошибка 403. Доступ запрещён",
            HttpCode::Status404 => "Ошибка 404. Такой страницы не найдено",
            HttpCode::Status405 => "Ошибка 405. Метод запроса не поддерживается по данному адресу",
            default => "Неизвестная ошибка"
        };
    }
}