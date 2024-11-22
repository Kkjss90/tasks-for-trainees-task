<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

if (!$USER->IsAdmin()) {
    LocalRedirect('/');
}

\Bitrix\Main\Loader::includeModule('iblock');

$IBLOCK_ID = 42;

$el = new CIBlockElement;
$arProps = [];

$rsPropEnums = CIBlockPropertyEnum::GetList(["SORT" => "ASC", "VALUE" => "ASC"], ["IBLOCK_ID" => $IBLOCK_ID]);
while ($enum = $rsPropEnums->Fetch()) {
    $arProps[$enum["PROPERTY_CODE"]][$enum["VALUE"]] = $enum["ID"];
}

function addEnumValue($propertyCode, $value, $iblockId, &$arProps) {
    $property = CIBlockProperty::GetList([], ["IBLOCK_ID" => $iblockId, "CODE" => $propertyCode])->Fetch();
    if ($property) {
        $result = CIBlockPropertyEnum::Add([
            "PROPERTY_ID" => $property["ID"],
            "VALUE" => $value
        ]);
        if ($result) {
            $arProps[$propertyCode][$value] = $result;
            return $result;
        }
    }
    return false;
}

function isDuplicate($name, $properties, $iblockId) {
    $filter = [
        "IBLOCK_ID" => $iblockId,
        "NAME" => $name,
    ];

    foreach ($properties as $key => $value) {
        $filter["PROPERTY_" . $key] = $value;
    }

    $rsElement = CIBlockElement::GetList([], $filter, false, false, ["ID"]);
    return $rsElement->SelectedRowsCount() > 0;
}

if (($handle = fopen("https://sasha1dx.beget.tech/myvacancy.csv", "r")) !== false) {
    $row = 1;
    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        if ($row == 1) {
            $row++;
            continue;
        }

        $PROP = [
            "OFFICE" => $data[0],
            "LOCATION" => $data[1],
            "DEPARTMENT" => $data[2],
            "SALARY" => $data[3],
            "REQUIREMENTS" => $data[4],
        ];

        foreach ($PROP as $key => &$value) {
            $value = trim($value);
            if (isset($arProps[$key])) {
                if (!isset($arProps[$key][$value])) {
                    $enumId = addEnumValue($key, $value, $IBLOCK_ID, $arProps);
                    if ($enumId) {
                        $value = $enumId;
                    } else {
                        echo "Ошибка при добавлении значения $value для свойства $key.<br>";
                    }
                } else {
                    $value = $arProps[$key][$value];
                }
            }
        }

        $elementName = $data[5];
        if (isDuplicate($elementName, $PROP, $IBLOCK_ID)) {
            echo "Элемент '$elementName' уже существует, пропуск.<br>";
            continue;
        }

        $arLoadProductArray = [
            "MODIFIED_BY" => $USER->GetID(),
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID" => $IBLOCK_ID,
            "PROPERTY_VALUES" => $PROP,
            "NAME" => $elementName,
            "ACTIVE" => "Y",
        ];

        if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
            echo "Добавлен элемент с ID: " . $PRODUCT_ID . "<br>";
        } else {
            echo "Ошибка: " . $el->LAST_ERROR . "<br>";
        }

        $row++;
    }
    fclose($handle);
} else {
    echo "Не удалось открыть файл data.csv.";
}
?>
