<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

if (!Loader::includeModule("form")) {
    ShowError("Модуль веб-форм не установлен.");
    return;
}

$componentClass = new CustomFormResultNewComponent($this);
$componentClass->executeComponent();
?>
