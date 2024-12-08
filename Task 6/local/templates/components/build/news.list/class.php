<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

class MyNewsListComponent extends CBitrixComponent
{
    protected function validateParams()
    {
        if (!is_array($this->arParams['FILTER']) && !empty($this->arParams['FILTER'])) {
            ShowError("Параметр FILTER должен быть массивом.");
            return false;
        }
        if (!empty($this->arParams['IBLOCK_ID']) && !is_numeric($this->arParams['IBLOCK_ID'])) {
            ShowError("Параметр IBLOCK_ID должен быть числом.");
            return false;
        }
        return true;
    }

    protected function getIblockElements()
    {
        $arFilter = [
            'ACTIVE' => 'Y',
        ];

        if (!empty($this->arParams['IBLOCK_ID'])) {
            $arFilter['IBLOCK_ID'] = $this->arParams['IBLOCK_ID'];
        } elseif (!empty($this->arParams['IBLOCK_TYPE'])) {
            $arFilter['IBLOCK_TYPE'] = $this->arParams['IBLOCK_TYPE'];
        } else {
            ShowError("Не указан тип или ID инфоблока.");
            return [];
        }

        if (!empty($this->arParams['FILTER']) && is_array($this->arParams['FILTER'])) {
            $arFilter = array_merge($arFilter, $this->arParams['FILTER']);
        }

        $arSelect = [
            "ID",
            "IBLOCK_ID",
            "NAME",
            "DETAIL_PAGE_URL",
            "PREVIEW_TEXT",
            "PREVIEW_PICTURE",
        ];

        $res = CIBlockElement::GetList(
            ["SORT" => "ASC"],
            $arFilter,
            false,
            false,
            $arSelect
        );

        $items = [];
        while ($item = $res->Fetch()) {
            $items[$item["IBLOCK_ID"]][] = $item;
        }

        return $items;
    }

    public function executeComponent()
    {
        if (!$this->validateParams()) {
            return;
        }

        if ($this->StartResultCache()) {
            $this->arResult['ITEMS'] = $this->getIblockElements();
            $this->includeComponentTemplate();
        }
    }
}
