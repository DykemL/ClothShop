<?php

namespace infrastructure\types;

class Route
{
    public string $controller;
    public string $action;

    public function __construct($controllerName, $actionName)
    {
        $this->controller = $controllerName;
        $this->action = $actionName;
    }
}