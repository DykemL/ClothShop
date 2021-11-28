<?php

namespace infrastructure\core;

use infrastructure\core\View;
use infrastructure\types\Route;

abstract class Controller {
	public Route $route;
	public View $view;

    public function __construct($route) {
		$this->route = $route;
		$this->view = new View($route);
	}

    protected function view(string $title = 'Страница', array $viewData = []) {
        $viewData['title'] = $title;
        $this->view->render($viewData);
    }
}