<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

class CustomFormResultNewComponent extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        $arParams["FORM_ID"] = intval($arParams["FORM_ID"]);
        return $arParams;
    }

    public function executeComponent()
    {
        if (!Loader::includeModule("form")) {
            ShowError("Модуль веб-форм не установлен.");
            return;
        }

        if ($this->request->isPost() && check_bitrix_sessid()) {
            $result = $this->processForm();
            if ($result["STATUS"] == "OK") {
                LocalRedirect($this->arParams["SUCCESS_URL"]);
            } else {
                $this->arResult["ERRORS"] = $result["ERRORS"];
            }
        }

        $this->includeComponentTemplate();
    }

    protected function processForm()
    {
        $formId = $this->arParams["FORM_ID"];
        $formValues = [
            "form_text_1" => $this->request->getPost("medicine_name"),
            "form_text_2" => $this->request->getPost("medicine_company"),
            "form_email_3" => $this->request->getPost("medicine_email"),
            "form_text_4" => $this->request->getPost("medicine_phone"),
            "form_textarea_5" => $this->request->getPost("medicine_message")
        ];

        $errors = [];
        foreach ($formValues as $fieldCode => $value) {
            if (empty($value) && $fieldCode != "message") {
                $errors[$fieldCode] = "Поле обязательно для заполнения";
            }
        }

        if (!empty($errors)) {
            return ["STATUS" => "ERROR", "ERRORS" => $errors];
        }

        $resultId = CFormResult::Add($formId, $formValues);
        if ($resultId) {
            return ["STATUS" => "OK"];
        } else {
            return ["STATUS" => "ERROR", "ERRORS" => ["Ошибка при сохранении формы"]];
        }
    }
}
?>
