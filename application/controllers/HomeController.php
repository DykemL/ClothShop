<?php

namespace application\controllers;

use application\services\PageService;
use application\services\ProductService;
use infrastructure\core\Controller;
use infrastructure\attributes\HttpGet;

class HomeController extends Controller {
    #[HttpGet]
	public function index() {
        $pageHtml = PageService::getPage(PageService::HOME_INDEX_ID)['html'];
		$this->view('Главная страница', ['pageHtml' => $pageHtml]);
	}

    #[HttpGet]
    public function aboutAuthor() {
        $pageHtml = PageService::getPage(PageService::HOME_ABOUT_AUTHOR_ID)['html'];
        $this->view('Об авторе', ['pageHtml' => $pageHtml]);
    }

    #[HttpGet]
    public function aboutCompany() {
        $pageHtml = PageService::getPage(PageService::HOME_ABOUT_COMPANY_ID)['html'];
        $this->view('О компании', ['pageHtml' => $pageHtml]);
    }

    #[HttpGet]
    public function products() {
        $productTypeName = null;
        if (isset($_GET['type'])) {
            $productTypeName = $_GET['type'];
        }
        $products = $productTypeName != null
            ? ProductService::getFullProductsByTypeName($productTypeName)
            : ProductService::getFullProducts();
        $this->view('Главная страница', ['products' => $products]);
    }

    #[HttpGet]
    public function product() {
        $productId = $_GET['productId'];
        $product = ProductService::getFullProduct($productId);
        $this->view('Продукт', ['product' => $product]);
    }
}