<?php

namespace My\Module;

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class UserFieldComplexProperty
{
    public static function GetUserTypeDescription()
    {
        return [
            'USER_TYPE_ID' => 'user_complex_property',
            'CLASS_NAME' => __CLASS__,
            'DESCRIPTION' => Loc::getMessage('MY_MODULE_USER_FIELD_COMPLEX_PROPERTY_DESCRIPTION'),
            'BASE_TYPE' => 'string',
            'GetEditFormHTML' => [__CLASS__, 'GetEditFormHTML'],
            'GetFilterHTML' => [__CLASS__, 'GetFilterHTML'],
            'GetAdminListViewHTML' => [__CLASS__, 'GetAdminListViewHTML'],
            'PrepareSettings' => [__CLASS__, 'PrepareSettings'],
            'GetSettingsHTML' => [__CLASS__, 'GetSettingsHTML'],
        ];
    }

    public static function GetEditFormHTML($arUserField, $arHtmlControl)
    {
        return '<textarea name="' . htmlspecialcharsbx($arHtmlControl['NAME']) . '" rows="10" cols="50">' .
            htmlspecialcharsbx($arHtmlControl['VALUE']) . '</textarea>';
    }

    public static function GetFilterHTML($arUserField, $arHtmlControl)
    {
        return '<input type="text" name="' . htmlspecialcharsbx($arHtmlControl['NAME']) . '" value="' .
            htmlspecialcharsbx($arHtmlControl['VALUE']) . '">';
    }

    public static function GetAdminListViewHTML($arUserField, $arHtmlControl)
    {
        return htmlspecialcharsbx($arHtmlControl['VALUE']);
    }

    public static function PrepareSettings($arUserField)
    {
        return [
            'DEFAULT_VALUE' => $arUserField['SETTINGS']['DEFAULT_VALUE'] ?? '',
        ];
    }

    public static function GetSettingsHTML($arUserField, $arHtmlControl, &$arUserFieldParams)
    {
        return '<tr>
    <td>' . Loc::getMessage('MY_MODULE_DEFAULT_VALUE') . ':</td>
    <td><textarea name="' . htmlspecialcharsbx($arHtmlControl['NAME'] . '[DEFAULT_VALUE]') . '">' .
            htmlspecialcharsbx($arUserField['SETTINGS']['DEFAULT_VALUE']) . '</textarea></td>
</tr>';
    }
}