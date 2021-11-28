<?php /* @var $products */ ?>

<link rel="stylesheet" href="/public/css/admin/index.css">

<button id="addProduct" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProductModal">Добавить продукт</button>

<table class="table table-sm table-striped mt-2">
    <tr>
        <th class="w-15">Название</th>
        <th class="w-15">Тип товара</th>
        <th class="w-15">Цена</th>
        <th class="w-15">Свойства</th>
        <th class="w-auto">Описание</th>
        <th class="w-15">Действия</th>
    </tr>
    <?php if (count($products) > 0)
        foreach ($products as $product): ?>
        <tr>
            <td><?= $product['name'] ?></td>
            <td><?= $product['product_type'] ?></td>
            <td><?= $product['price'] ?></td>
            <td><?= $product['properties'] ?></td>
            <td><?= $product['description'] ?></td>
            <td>
                <i class="fa fa-pencil ico-action update-product" data-productid="<?= $product['id'] ?>" data-bs-toggle="modal" data-bs-target="#createProductModal"></i>
                <i id="deleteProduct" type="button" class="fa fa-times ico-action-red" data-productid="<?= $product['id'] ?>" data-bs-toggle="modal" data-bs-target="#deleteProductModal"></i>
            </td>
        </tr>
    <?php endforeach ?>
</table>

<!-- Product modal -->
<div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Добавление товара</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="modalForm" class="modal-body" enctype="multipart/form-data" method="post" action="/admin/addProduct">
                <div class="modal-body">
                    <div class="form-floating mb-2">
                        <input name="productName" type="text" class="form-control" id="productName" placeholder="Название товара">
                        <label for="productName">Название товара</label>
                    </div>
                    <div class="form-floating mb-2">
                        <select name="productType" class="form-select" id="productTypeSelect" aria-label="Тип товара">
                            <option value="1">Футболки</option>
                            <option value="2">Брюки</option>
                            <option value="3">Куртки</option>
                            <option value="0" selected>Другое</option>
                        </select>
                        <label for="productTypeSelect">Тип товара</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input name="productPrice" type="text" class="form-control" id="productPrice" placeholder="Цена">
                        <label for="productPrice">Цена</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input name="productProperties" type="text" class="form-control" id="productProperties" placeholder="Свойства">
                        <label for="productProperties">Свойства</label>
                    </div>
                    <div class="form-floating mb-2">
                        <textarea name="productDescription" class="form-control mb-2" placeholder="Описание" id="productDescription" style="height: 100px"></textarea>
                        <label for="productDescription">Описание</label>
                    </div>
                    <div class="form-floating mb-2">
                        <div class="input-group">
                            <input name="productImage" id="productImage" type="file" class="form-control">
                        </div>
                    </div>
                </div>
                <input id="productId" name="productId" type="text" class="d-none">
                <div class="modal-footer">
                    <button id="modalButton" type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete confirm modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Предупреждение</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="fs-5">Вы уверены?</div>
            </div>
            <form id="modalForm" class="modal-footer" enctype="multipart/form-data" method="post" action="/admin/addProduct">
                <input id="deleteProductId" name="productId" type="text" class="d-none">
                <a href="/admin/deleteProduct?id=" id="modalDeleteButton" type="submit" class="btn btn-primary">Удалить</a>
            </form>
        </div>
    </div>
</div>

<script src="/public/js/pageControllers/admin/index.js"></script>