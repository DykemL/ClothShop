<?php

namespace application\utils;

abstract class ValidationUtils
{
    public static function addError(string $errorMessage) {
        if (!isset($_SESSION['VALIDATION_ERRORS'])) {
            $_SESSION['VALIDATION_ERRORS'] = [];
        }
        array_push($_SESSION['VALIDATION_ERRORS'], $errorMessage);
    }

    public static function popErrors() {
        $errors = $_SESSION['VALIDATION_ERRORS'];
        $_SESSION['VALIDATION_ERRORS'] = [];
        return $errors;
    }

    public static function popFirstError() {
        return array_shift($_SESSION['VALIDATION_ERRORS']);
    }

    public static function isErrorsEmpty(): bool {
        return (!isset($_SESSION['VALIDATION_ERRORS'])) || count($_SESSION['VALIDATION_ERRORS']) == 0;
    }
}