<?php

namespace application\services;

use infrastructure\utils\Db;

abstract class ProductService
{
    public static function addProduct($name, $price = "", $properties = "", $description = "", $type = 0, $image_id = null) : bool {
        $newId = Db::createNewToken();
        $name = htmlspecialchars($name);
        $type = htmlspecialchars($type);
        $price = htmlspecialchars($price);
        $properties = htmlspecialchars($properties);
        $description = htmlspecialchars($description);

        if ($image_id == null) {
            $image_id = ImageService::DEFAULT_IMAGE_ID;
        }

        $productTypeId = Db::queryFetchSingle("SELECT * FROM `product_types` WHERE type='$type'")['id'];
        if (!Db::query("INSERT INTO `products` (id, name, product_type_id, price, properties, description, image_id) 
                        VALUES ('$newId', '$name', '$productTypeId', '$price', '$properties', '$description', '$image_id')")) {
            return false;
        }
        return true;
    }

    public static function updateProduct($id, $name, $price = "", $properties = "", $description = "", $type = 0, $image_id = null) : bool {
        $name = htmlspecialchars($name);
        $type = htmlspecialchars($type);
        $price = htmlspecialchars($price);
        $properties = htmlspecialchars($properties);
        $description = htmlspecialchars($description);

        $productTypeId = Db::queryFetchSingle("SELECT * FROM `product_types` WHERE type='$type'")['id'];
        $baseRequest = "UPDATE `products` SET name='$name', product_type_id='$productTypeId', price='$price', properties='$properties', description='$description'";
        if ($image_id != null) {
            $baseRequest = $baseRequest.", image_id='$image_id'";
        }
        $request = $baseRequest."WHERE id='$id'";

        if (!Db::query($request)) {
            return false;
        }
        return true;
    }

    public static function getProducts() : array {
        return Db::queryFetch("SELECT * FROM `products` ORDER BY name");
    }

    public static function getProduct($productId) : array {
        return Db::queryFetchSingle("SELECT * FROM `products` WHERE id='$productId'");
    }

    public static function getFullProduct($productId) : array {
        $product = Db::queryFetchSingle("SELECT * FROM `products` WHERE id='$productId'");
        $productType = self::getProductType($product['product_type_id']);
        $imagePath = ImageService::getImage($product['image_id']);
        $product['product_type'] = $productType['name'];
        $product['image_path'] = $imagePath['image_path'];
        return $product;
    }

    public static function getFullProducts() : array {
        $products = Db::queryFetch("SELECT * FROM `products` ORDER BY name");
        $productsCount = count($products);
        for ($i = 0; $i < $productsCount; $i++) {
            $product = $products[$i];
            $productType = self::getProductType($product['product_type_id']);
            $imagePath = ImageService::getImage($product['image_id']);
            $products[$i]['product_type'] = $productType['name'];
            $products[$i]['image_path'] = $imagePath['image_path'];
        }
        return $products;
    }

    public static function getFullProductsByTypeName($typeName) : array {
        $fullProducts = self::getFullProducts();
        $filteredProducts = [];
        foreach ($fullProducts as $product) {
            if ($product['product_type'] == $typeName) {
                array_push($filteredProducts, $product);
            }
        }
        return $filteredProducts;
    }

    public static function deleteProduct($id) : bool {
        return Db::query("DELETE FROM `products` WHERE id='$id'");
    }

    public static function getProductType($id) : array {
        return Db::queryFetchSingle("SELECT * FROM `product_types` WHERE id='$id'");
    }

    public static function getProductTypes() : array {
        return Db::queryFetch("SELECT * FROM `product_types`");
    }
}