<?php

namespace infrastructure\core;

use infrastructure\types\AttributePath;
use infrastructure\types\HttpCode;
use infrastructure\types\RequestMethod;
use infrastructure\types\Route;
use ReflectionClass;

class Router {
    private array $customRoutes = [];

    public function __construct(array $routes) {
        foreach ($routes as $customRoute => $realRoute) {
            $route = '#^'.$customRoute.'$#';
            $this->customRoutes[$route] = $realRoute;
        }
    }

    public function run() {
        $route = $this->calculateRoute();
        if ($route == null) {
            View::error(HttpCode::Status404);
        }
        $controller = $route->controller;
        $action = $route->action;

        $path = 'application\\controllers\\'.ucfirst($controller).'Controller';
        if (!class_exists($path) || !method_exists($path, $action)) {
            View::error(HttpCode::Status404);
        }
        $controller = new $path($route);
        $currentRequestMethod = $_SERVER['REQUEST_METHOD'];
        if (!$this->checkMethodForHttpAttribute($controller, $action, $currentRequestMethod)) {
            View::error(HttpCode::Status405);
        }
        $controller->$action();
    }

    private function calculateRoute(): ?Route {
        $fullUrl = trim($_SERVER['REQUEST_URI'], '/');
        $urlOrFalse = stristr($fullUrl, '?', true);
        $url = $urlOrFalse == false ? $fullUrl : $urlOrFalse;
        $route = $this->findInCustomRoutes($url);
        if ($route == null) {
            $pathArray = explode('/', $url);
            if (count($pathArray) != 2) {
                return null;
            }
            $route = new Route($pathArray[0], $pathArray[1]);
        }
        return $route;
    }

    private function findInCustomRoutes(string $url) : ?Route {
        foreach ($this->customRoutes as $route => $requestPath) {
            if (preg_match($route, $url)) {
                return $requestPath;
            }
        }
        return null;
    }

    private function checkMethodForHttpAttribute(Controller $controller, $method, $requestMethod): bool {
        try {
            $reflection = new ReflectionClass($controller);
            $methodAttributes = $reflection->getMethod($method)->getAttributes();
            $attributePath = $this->toAttributePath($requestMethod);
            $httpMethodAttributes = array_filter($methodAttributes, function ($attribute) use ($attributePath) {
                return $attribute->getName() == $attributePath;
            });
            return count($httpMethodAttributes) > 0;
        } catch (\ReflectionException) {
            return false;
        }
    }

    private function toAttributePath ($requestMethod): string {
        return match($requestMethod) {
            RequestMethod::Get => AttributePath::HttpGet,
            RequestMethod::Post => AttributePath::HttpPost
        };
    }
}