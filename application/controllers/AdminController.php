<?php

namespace application\controllers;

use application\services\AdminService;
use application\services\ImageService;
use application\services\PageService;
use application\services\ProductService;
use application\utils\ValidationUtils;
use infrastructure\attributes\HttpGet;
use infrastructure\attributes\HttpPost;
use infrastructure\core\Controller;
use infrastructure\core\View;
use infrastructure\types\HttpCode;

class AdminController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        $this->view->defaultLayout = 'admin';

        if ($route->action != 'login' && $route->action != 'handleLogin') {
            if (!AdminService::isAdminAuthorized()) {
                View::error(HttpCode::Status403);
            }
        }
    }

    #[HttpGet]
    public function index() {
        $products = ProductService::getFullProducts();
        $this->view('Панель администратора', ['products' => $products]);
    }

    #[HttpGet]
    public function editPage() {
        $id = $_GET['id'];

        $page = PageService::getPage($id);
        $this->view('Редактирование страницы', ['description' => PageService::ID_TO_PAGE_EDIT_TITLE[$id], 'page' => $page]);
    }

    #[HttpGet]
    public function login() {
        $this->view->render(['title' => 'Вход в панель администратора'], 'default');
    }

    #[HttpGet]
    public function deleteProduct() {
        $id = $_GET['id'];

        ProductService::deleteProduct($id);
        View::redirect('/admin/index');
    }

    #[HttpGet]
    public function logout() {
        AdminService::logout();
        View::redirect('/home/index');
    }

    #[HttpPost]
    public function handleLogin() {
        $login = $_POST['login'];
        $password = $_POST['password'];
        if (!AdminService::login($login, $password)) {
            ValidationUtils::addError('Неправильный логин или пароль');
            View::redirect('/admin/login');
        }
        View::redirect('/admin/index');
    }

    #[HttpPost]
    public function addProduct() {
        $imageId = null;
        if ($this->moveImageFromFiles()) {
            $imageId = ImageService::addImage($_FILES['productImage']['name']);
        }

        if (!ProductService::addProduct($_POST['productName'], $_POST['productPrice'], $_POST['productProperties'],
            $_POST['productDescription'], $_POST['productType'], $imageId)) {
            View::error(HttpCode::Status400);
        }
        View::redirect('/admin/index');
    }

    #[HttpPost]
    public function updateProduct() {
        $imageId = null;
        if ($this->moveImageFromFiles()) {
            $imageId = ImageService::addImage($_FILES['productImage']['name']);
        }

        if (!ProductService::updateProduct($_POST['productId'], $_POST['productName'], $_POST['productPrice'], $_POST['productProperties'],
            $_POST['productDescription'], $_POST['productType'], $imageId)) {
            View::error(HttpCode::Status400);
        }
        View::redirect('/admin/index');
    }

    private function moveImageFromFiles() : string {
        $pathToImageDir = $_SERVER['DOCUMENT_ROOT']."\\public\\images\\productImages\\".basename($_FILES['productImage']['name']);
        if (isset($_FILES['productImage']) && $_FILES['productImage']['size'] != 0) {
            if (!move_uploaded_file($_FILES['productImage']['tmp_name'], $pathToImageDir)) {
                return false;
            }
            return true;
        }
        return false;
    }

    #[HttpPost]
    public function updatePage() {
        $pageId = $_POST['pageId'];
        $pageHtml = $_POST['pageHtml'];
        if (!PageService::updagePage($pageId, $pageHtml)) {
            View::error(HttpCode::Status400);
        }
        View::redirect("/admin/editPage?id=$pageId");
    }

    #[HttpPost]
    public function getProduct() {
        $productId = $_POST['productId'];
        header('Content-Type: application/json');
        $product = ProductService::getProduct($productId);
        $product['type'] = ProductService::getProductType($product['product_type_id'])['type'];
        echo json_encode($product);
    }
}