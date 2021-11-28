<?php
/* @var $title string */
/* @var $content */
use \application\services\AdminService;
require 'application/helpers/pageHelpers.php';
?>

<!DOCTYPE html>
<html lang="ru" class="h-100">
<head>
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="/public/lib/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/public/lib/bootstrap-5.1.3/css/bootstrap.min.css">

    <link rel="stylesheet" href="/public/css/styles.css">
    <link rel="stylesheet" href="/public/css/layouts/base.css">
</head>
<body class="d-flex flex-column h-100">
    <div class="container-fluid">
        <header class="d-flex flex-wrap justify-content-center p-3 mb-4 shadow">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <img class="logo" src="/public/images/logo.png" alt="">
            </a>

            <ul class="nav">
                <li class="nav-item">
                    <a href="/" class="nav-link link-dark hover-primary <?= activePage('index') ?>">Главная</a>
                </li>
                <li class="nav-item">
                    <a href="/home/aboutAuthor" class="nav-link link-dark hover-primary <?= activePage('aboutAuthor') ?>">Об авторе</a>
                </li>
                <li class="nav-item">
                    <a href="/home/aboutCompany" class="nav-link link-dark hover-primary <?= activePage('aboutCompany') ?>">О компании</a>
                </li>
                <?php if (AdminService::isAdminAuthorized()): ?>
                    <li class="nav-item">
                        <a href="/admin/index" class="nav-link link-dark hover-primary">Админ-панель</a>
                    </li>
                <?php endif ?>
            </ul>
        </header>
        <div class="row">
            <aside class="aside col-md-2 d-flex flex-column flex-shrink-0 p-3 bg-light shadow">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li><a href="/home/products" class="nav-link link-dark hover-primary <?= activePage('products') ?>"><i class="fa fa-tag"></i> Товары</a></li>
                    <hr>
                    <li><a href="/home/products?type=Футболки" class="nav-link link-dark"><i class="fa fa-filter"></i> Футболки</a></li>
                    <li><a href="/home/products?type=Брюки" class="nav-link link-dark"><i class="fa fa-filter"></i> Брюки</a></li>
                    <li><a href="/home/products?type=Куртки" class="nav-link link-dark"><i class="fa fa-filter"></i> Куртки</a></li>
                    <li><a href="/home/products?type=Другое" class="nav-link link-dark"><i class="fa fa-filter"></i> Другое</a></li>
                </ul>
            </aside>
            <main class="col-md-10 p-3"><?= $content; ?></main>
        </div>
    </div>
    <footer class="footer mt-auto p-2 bg-light">
        <div class="container">
            &copy; 2021 Cloth Shop. <a href="mailto:clothshop@gmail.com">clothshop@gmail.com</a>
        </div>
    </footer>
    <script src="/public/lib/bootstrap-5.1.3/js/bootstrap.js"></script>
</body>
</html>