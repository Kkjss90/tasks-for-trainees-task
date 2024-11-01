<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
    "NAME" => GetMessage("FORM"),
    "DESCRIPTION" => GetMessage("FORM_DESCR"),
    "ICON" => "",
    "PATH" => array(
        "ID" => "service",
        "CHILD" => array(
            "NAME" => GetMessage("FORM_SERVICE")
        ),
    ),
    "AREA_BUTTONS" => array(
        array(
            'URL' => "javascript:alert('Это кнопка!!!');",
            'SRC' => '/images/button.jpg',
            'TITLE' => "Это кнопка!"
        ),
    ),
    "CACHE_PATH" => "Y"
);
?>