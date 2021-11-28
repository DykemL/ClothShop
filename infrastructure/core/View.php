<?php

namespace infrastructure\core;

use infrastructure\types\Route;
use infrastructure\utils\HttpUtils;

class View {
	public string $path;
	public Route $route;
	public string $defaultLayout;

	public function __construct($route, $defaultLayout = 'base') {
        $this->path = $route->controller.'/'.$route->action;
        $this->route = $route;
        $this->defaultLayout = $defaultLayout;
	}

	public function render(array $viewData = [], $defaultLayout = null) {
        $_SESSION['REAL_ROUTE'] = $this->route->controller.'/'.$this->route->action;
        self::staticRender($this->path, $defaultLayout != null ? $defaultLayout : $this->defaultLayout, $viewData);
	}

    public static function redirect($url) {
        header('location: '.$url);
        exit;
    }

    public static function staticRender(string $viewPath, string $layoutPath, array $viewData = []) {
        $viewFullPath = 'application/views/'.$viewPath.'.php';
        $layoutFullPath = 'application/views/layouts/'.$layoutPath.'.php';
        if (file_exists($viewFullPath) && file_exists($layoutFullPath)) {
            extract($viewData);
            ob_start();
            require $viewFullPath;
            $content = ob_get_clean();
            require $layoutFullPath;
        }
    }

    public static function error(int $httpCode) {
        http_response_code($httpCode);
        $viewPath = 'shared/message';
        $layoutPath = 'default';
        $message = HttpUtils::toHttpMessage($httpCode);
        self::staticRender($viewPath, $layoutPath, ['title' => 'Ошибка', 'message' => $message]);
        exit;
    }
}	