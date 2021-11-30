<?php

namespace application\services;

use infrastructure\utils\Db;

abstract class PageService
{
    public const HOME_INDEX_ID = 'f74006ae57c1a0bcdab1884614cb640e';
    public const HOME_ABOUT_AUTHOR_ID = 'd7b2f541a15dbb769accdf994915bc37';
    public const HOME_ABOUT_COMPANY_ID = '1db53fcbab16fa34bcc27cbe125f2090';

    public const ID_TO_PAGE_EDIT_TITLE = [
        self::HOME_INDEX_ID => 'Редактирование главной страницы',
        self::HOME_ABOUT_AUTHOR_ID => 'Редактирование страницы "об авторе"',
        self::HOME_ABOUT_COMPANY_ID => 'Редактирование страницы "о компании"'
    ];

    public static function getPage($id) : array {
        $id = htmlspecialchars($id);
        return Db::queryFetchSingle("SELECT * FROM `pages` WHERE id='$id'");
    }

    public static function updagePage($id, $html) : bool {
        $id = htmlspecialchars($id);
        $html = htmlspecialchars($html);
        return Db::query("UPDATE `pages` SET html='$html' WHERE id='$id'");
    }
}