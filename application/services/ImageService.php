<?php

namespace application\services;

use infrastructure\utils\Db;

abstract class ImageService
{
    public const DEFAULT_IMAGE_ID = '123273bdf623daba905bc7a702590a4e';
    public const PATH_TO_PRODUCT_IMAGES = '/public/images/productImages/';

    public static function addImage($imagePath) : string | bool {
        $imagePath = htmlspecialchars($imagePath);
        $id = Db::createNewToken();
        if (!Db::query("INSERT INTO `images` (id, image_path) VALUES ('$id', '$imagePath')")) {
            return false;
        }
        return $id;
    }

    public static function getImage($id) : array {
        return Db::queryFetchSingle("SELECT * FROM `images` WHERE id='$id'");
    }

    public static function getAllImages() : array {
        return Db::queryFetch("SELECT * FROM `images`");
    }
}