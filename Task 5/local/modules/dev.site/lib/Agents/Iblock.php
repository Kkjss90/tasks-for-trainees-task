<?php

namespace Only\Site\Agents;


class Iblock
{
    public static function clearOldLogs()
    {
        if (!Loader::includeModule('iblock')) {
            return '\\' . __CLASS__ . '::' . __FUNCTION__ . '();';
        }

        $IBLOCK_CODE = 'LOG';
        $IBLOCK_ID = null;

        $res = CIBlock::GetList([], ['CODE' => $IBLOCK_CODE]);
        if ($arRes = $res->Fetch()) {
            $IBLOCK_ID = $arRes['ID'];
        }

        if (!$IBLOCK_ID) {
            AddMessage2Log("Инфоблок с кодом {$IBLOCK_CODE} не найден.");
            return '\\' . __CLASS__ . '::' . __FUNCTION__ . '();';
        }

        $resElements = CIBlockElement::GetList(
            ['ACTIVE_FROM' => 'DESC'],
            ['IBLOCK_ID' => $IBLOCK_ID],
            false,
            false,
            ['ID']
        );

        $elements = [];
        while ($arElement = $resElements->Fetch()) {
            $elements[] = $arElement['ID'];
        }

        if (count($elements) > 10) {
            $arDelElements = array_slice($elements, 10);

            foreach ($arDelElements as $elementId) {
                if (CIBlockElement::Delete($elementId)) {
                    AddMessage2Log("Запись с ID-{$elementId} удалена.");
                } else {
                    AddMessage2Log("Ошибка удаления записи с ID-{$elementId}");
                }
            }
        }

        return '\\' . __CLASS__ . '::' . __FUNCTION__ . '();';
    }
    public static function example()
    {
        global $DB;
        if (\Bitrix\Main\Loader::includeModule('iblock')) {
            $iblockId = \Only\Site\Helpers\IBlock::getIblockID('QUARRIES_SEARCH', 'SYSTEM');
            $format = $DB->DateFormatToPHP(\CLang::GetDateFormat('SHORT'));
            $rsLogs = \CIBlockElement::GetList(['TIMESTAMP_X' => 'ASC'], [
                'IBLOCK_ID' => $iblockId,
                '<TIMESTAMP_X' => date($format, strtotime('-1 months')),
            ], false, false, ['ID', 'IBLOCK_ID']);
            while ($arLog = $rsLogs->Fetch()) {
                \CIBlockElement::Delete($arLog['ID']);
            }
        }
        return '\\' . __CLASS__ . '::' . __FUNCTION__ . '();';
    }
}
