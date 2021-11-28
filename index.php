<?php

spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
});

use infrastructure\core\Router;
use infrastructure\utils\Db;

require 'infrastructure/helpers/debug.php';
enableDebugMode();
session_start();
Db::init();

$routes = require 'application/config/routes.php';
$router = new Router($routes);
$router->run();