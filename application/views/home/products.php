<?php /* @var $products */ ?>

<link rel="stylesheet" href="/public/css/home/products.css">
<div class="d-flex flex-row flex-wrap">
<?php if (count($products) > 0) foreach ($products as $product): ?>
    <div class="card product-card ml-2">
        <img class="product-image" src="/public/images/productImages/<?= $product['image_path'] ?>" alt="Картинка">
        <div class="card-body">
            <a class="h5" href="/home/product?productId=<?= $product['id'] ?>"><?= $product['name'] ?></a>
            <div class="small text-secondary"><?= $product['properties'] ?></div>
            <div class="font-weight-bold mt-1"><?= $product['price'] ?>&#8381</div>
        </div>
    </div>
<?php endforeach ?>
</div>
