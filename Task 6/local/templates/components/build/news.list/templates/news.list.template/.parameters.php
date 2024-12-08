<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arTemplateParameters = [
    "SHOW_PREVIEW_TEXT" => [
        "PARENT" => "VISUAL",
        "NAME" => "Показывать текст анонса",
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "Y",
    ],
    "SHOW_PREVIEW_PICTURE" => [
        "PARENT" => "VISUAL",
        "NAME" => "Показывать картинку анонса",
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "Y",
    ],
];
