<?php
/* @var $title string */
/* @var $content */
use application\services\PageService;
require 'application/helpers/pageHelpers.php'
?>

<!DOCTYPE html>
<html lang="ru" class="h-100">
<head>
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="/public/lib/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/public/lib/bootstrap-5.1.3/css/bootstrap.min.css">

    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body class="h-100">
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-md-2 h-auto p-0">
                <div class="d-flex flex-column p-3 text-white bg-dark h-100 text-center">
                    <div class="h-100 w-100">
                        <span class="fs-5">Панель администратора</span>
                        <hr>
                        <a href="/admin/index" class="btn btn-info w-100">Товары</a>
                        <hr>
                        <div class="mt-2">Редактирование</div>
                        <a href="/admin/editPage?id=<?= PageService::HOME_INDEX_ID ?>" class="btn btn-info w-100 mt-2">Главная страница</a>
                        <a href="/admin/editPage?id=<?= PageService::HOME_ABOUT_AUTHOR_ID ?>" class="btn btn-info w-100 mt-2">Об авторе</a>
                        <a href="/admin/editPage?id=<?= PageService::HOME_ABOUT_COMPANY_ID ?>" class="btn btn-info w-100 mt-2">О фирме</a>
                    </div>
                    <hr>
                    <a href="/home/index" class="btn btn-info">На главную</a>
                    <a href="/admin/logout" class="btn btn-info mt-2">Выйти из аккаунта</a>
                </div>
            </div>
            <div class="col-md-10 p-3">
                <?= $content ?>
            </div>
        </div>
    </div>
    <script src="/public/lib/bootstrap-5.1.3/js/bootstrap.js"></script>
</body>
</html>