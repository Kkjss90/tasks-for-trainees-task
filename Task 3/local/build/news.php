<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/** @global CMain $APPLICATION */
/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);

if ($arParams["USE_RSS"] == "Y") {
    $APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" href="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" />');
    echo '<a href="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" title="rss" target="_self"><img alt="RSS" src="'.$templateFolder.'/images/gif-light/feed-icon-16x16.gif" border="0" align="right" /></a>';
}

if ($arParams["USE_SEARCH"] == "Y") {
    echo GetMessage("SEARCH_LABEL");
    $APPLICATION->IncludeComponent(
        "bitrix:search.form",
        "flat",
        ["PAGE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["search"]],
        $component,
        ['HIDE_ICONS' => 'Y']
    );
    echo '<br />';
}

if ($arParams["USE_FILTER"] == "Y") {
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.filter",
        "",
        [
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "FILTER_NAME" => $arParams["FILTER_NAME"],
            "FIELD_CODE" => $arParams["FILTER_FIELD_CODE"],
            "PROPERTY_CODE" => $arParams["FILTER_PROPERTY_CODE"],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        ],
        $component,
        ['HIDE_ICONS' => 'Y']
    );
    echo '<br />';
}

if (isset($arResult["VARIABLES"]["ELEMENT_ID"]) || isset($arResult["VARIABLES"]["ELEMENT_CODE"])) {
    $APPLICATION->IncludeComponent(
        "bitrix:news.detail",
        "mytemplate",
        [
            "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
            "DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
            "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
            "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
            "PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
            "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            "ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
            "ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
            "USE_SHARE" => $arParams["USE_SHARE"],
        ],
        $component
    );

    if ($arParams["USE_RATING"] == "Y") {
        $APPLICATION->IncludeComponent(
            "bitrix:iblock.vote",
            "",
            [
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
            ],
            $component
        );
    }
} else {
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "mytemplate",
        [
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "NEWS_COUNT" => $arParams["NEWS_COUNT"],
            "SORT_BY1" => $arParams["SORT_BY1"],
            "SORT_ORDER1" => $arParams["SORT_ORDER1"],
            "SORT_BY2" => $arParams["SORT_BY2"],
            "SORT_ORDER2" => $arParams["SORT_ORDER2"],
            "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
            "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
            "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        ],
        $component
    );
}
?>
