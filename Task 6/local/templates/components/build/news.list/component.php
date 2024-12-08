<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

if (!Loader::includeModule("iblock")) {
    ShowError("Модуль инфоблоков не установлен.");
    return;
}

CBitrixComponent::includeComponentClass("mycomponents:mynewslist");

$component = new MyNewsListComponent();
$component->initComponent($this->getName(), $this->getTemplateName());
$component->arParams = $this->arParams;
$component->arResult = $this->arResult;

$component->executeComponent();
