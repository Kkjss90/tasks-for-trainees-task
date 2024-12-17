<?php
namespace My\Module;

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class ComplexProperty
{
    public static function GetUserTypeDescription()
    {
        return [
            "PROPERTY_TYPE" => "S",
            "USER_TYPE" => "ComplexProperty",
            "DESCRIPTION" => Loc::getMessage("MY_MODULE_COMPLEX_PROPERTY_DESCRIPTION"),
            "GetPropertyFieldHtml" => [__CLASS__, "GetPropertyFieldHtml"],
            "GetPropertyFieldHtmlMulty" => [__CLASS__, "GetPropertyFieldHtmlMulty"],
            "ConvertToDB" => [__CLASS__, "ConvertToDB"],
            "ConvertFromDB" => [__CLASS__, "ConvertFromDB"],
            "PrepareSettings" => [__CLASS__, "PrepareSettings"],
            "GetSettingsHTML" => [__CLASS__, "GetSettingsHTML"],
        ];
    }

    public static function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
    {
        ob_start();
        echo '<textarea name="' . htmlspecialcharsbx($strHTMLControlName['VALUE']) . '" rows="10" cols="50">';
        echo htmlspecialcharsbx($value['VALUE']);
        echo '</textarea>';
        return ob_get_clean();
    }

    public static function GetPropertyFieldHtmlMulty($arProperty, $value, $strHTMLControlName)
    {
        ob_start();
        foreach ($value as $val) {
            echo '<textarea name="' . htmlspecialcharsbx($strHTMLControlName['VALUE'] . '[]') . '" rows="5" cols="50">';
            echo htmlspecialcharsbx($val['VALUE']);
            echo '</textarea><br>';
        }
        echo '<button type="button" onclick="addNewField(this)">Добавить поле</button>';
        echo '<script>
            function addNewField(btn) {
                var container = btn.previousElementSibling;
                var newField = document.createElement("textarea");
                newField.name = container.name;
                newField.rows = 5;
                newField.cols = 50;
                btn.parentNode.insertBefore(newField, btn);
            }
        </script>';
        return ob_get_clean();
    }

    public static function PrepareSettings($arProperty)
    {
        return ["DEFAULT_VALUE" => $arProperty["DEFAULT_VALUE"] ?? ""];
    }

    public static function GetSettingsHTML($arProperty, $strHTMLControlName, &$arPropertyFields)
    {
        $arPropertyFields = ["HIDE" => ["ROW_COUNT", "COL_COUNT"], "SET" => ["MULTIPLE_CNT" => 1]];

        return '<tr>
            <td>' . Loc::getMessage("MY_MODULE_DEFAULT_VALUE") . ':</td>
            <td><textarea name="' . htmlspecialcharsbx($strHTMLControlName["DEFAULT_VALUE"]) . '">' .
            htmlspecialcharsbx($arProperty["DEFAULT_VALUE"]) . '</textarea></td>
        </tr>';
    }

    public static function ConvertToDB($arProperty, $value)
    {
        return ["VALUE" => json_encode($value["VALUE"]), "DESCRIPTION" => $value["DESCRIPTION"]];
    }

    public static function ConvertFromDB($arProperty, $value)
    {
        $value["VALUE"] = json_decode($value["VALUE"], true);
        return $value;
    }
}

