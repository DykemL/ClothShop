<?php
/* @var $page */
/* @var $description */
?>

<link rel="stylesheet" href="/public/css/admin/editPage.css">

<div class="text-primary fs-5"><?= $description ?></div>

<form class="h-100" method="post" action="/admin/updatePage">
    <button class="btn btn-lg btn-primary mt-2" type="submit">Сохранить</button>
    <div class="form-floating mt-2 mb-2 h-100">
        <textarea name="pageHtml" class="form-control" placeholder="Описание" id="editPage"><?=$page['html']?></textarea>
        <label class="text-primary" for="editPage">HTML</label>
    </div>
    <input name="pageId" class="d-none" type="text" value="<?= $page['id'] ?>">
</form>

<script src="/public/js/pageControllers/admin/editPage.js"></script>