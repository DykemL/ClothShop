<?php use application\utils\ValidationUtils; ?>

<link rel="stylesheet" href="/public/css/admin/login.css">
<div class="container form-login">
    <?php if (!ValidationUtils::isErrorsEmpty()): ?>
        <div class="alert alert-danger mt-1 text-center"><?= ValidationUtils::popFirstError() ?></div>
    <?php endif ?>
    <form class="text-center" method="post" action="/admin/handleLogin">
        <h1 class="h3 mb-3 fw-normal">Вход в панель администратора</h1>
        <div class="form-floating">
            <input name="login" type="text" class="form-control" id="floatingInput" placeholder="Логин">
            <label for="floatingInput">Логин</label>
        </div>
        <div class="form-floating">
            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Пароль">
            <label for="floatingPassword">Пароль</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Войти</button>
    </form>
</div>