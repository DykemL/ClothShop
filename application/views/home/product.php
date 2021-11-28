<?php /* @var $product */ ?>

<link rel="stylesheet" href="/public/css/home/product.css">
<div class="p-3 mt-5">
    <img class="product-image" src="/public/images/productImages/<?= $product['image_path'] ?>" alt="Картинка">
    <h3 class="font-weight-bold text-info"><?= $product['name'] ?></h3>
    <h5 class="mt-2">Тип: <span class="text-warning"><?= $product['product_type'] ?></span></h5>
    <h5 class="mt-2">Цена: <span class="text-warning"><?= $product['price'] ?><i class="fa fa-rub"></i></span></h5>
    <h5 class="mt-2">Параметры: <span class="text-warning"><?= $product['properties'] ?></span></h5>
    <h5 class="mt-2">Описание:</h5>
    <p><?= $product['description'] ?></p>
</div>