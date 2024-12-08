<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

if (!Loader::includeModule("iblock")) {
    return;
}

$arComponentParameters = [
    "GROUPS" => [],
    "PARAMETERS" => [
        "IBLOCK_TYPE" => [
            "PARENT" => "BASE",
            "NAME" => "Тип инфоблока",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "IBLOCK_ID" => [
            "PARENT" => "BASE",
            "NAME" => "ID инфоблока",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "FILTER" => [
            "PARENT" => "BASE",
            "NAME" => "Фильтр",
            "TYPE" => "STRING",
            "MULTIPLE" => "Y",
            "DEFAULT" => [],
        ],
        "CACHE_TIME" => [
            "DEFAULT" => 3600,
        ],
    ],
];
