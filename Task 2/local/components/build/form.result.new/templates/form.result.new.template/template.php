<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<form class="contact-form__form" action="<?=POST_FORM_ACTION_URI?>" method="POST">
    <?=bitrix_sessid_post()?>

    <div class="contact-form__form-inputs">
        <div class="input contact-form__input">
            <label class="input__label" for="medicine_name">
                <div class="input__label-text">Ваше имя*</div>
                <input class="input__input" type="text" id="medicine_name" name="medicine_name" required>
                <?php if (isset($arResult["ERRORS"]["name"])): ?>
                    <div class="input__notification"><?=$arResult["ERRORS"]["name"]?></div>
                <?php endif; ?>
            </label>
        </div>

        <div class="input contact-form__input">
            <label class="input__label" for="medicine_company">
                <div class="input__label-text">Компания/Должность*</div>
                <input class="input__input" type="text" id="medicine_company" name="medicine_company" required>
                <?php if (isset($arResult["ERRORS"]["company"])): ?>
                    <div class="input__notification"><?=$arResult["ERRORS"]["company"]?></div>
                <?php endif; ?>
            </label>
        </div>

        <div class="input contact-form__input">
            <label class="input__label" for="medicine_email">
                <div class="input__label-text">Email*</div>
                <input class="input__input" type="email" id="medicine_email" name="medicine_email" required>
                <?php if (isset($arResult["ERRORS"]["email"])): ?>
                    <div class="input__notification"><?=$arResult["ERRORS"]["email"]?></div>
                <?php endif; ?>
            </label>
        </div>

        <div class="input contact-form__input">
            <label class="input__label" for="medicine_phone">
                <div class="input__label-text">Номер телефона*</div>
                <input class="input__input" type="tel" id="medicine_phone" name="medicine_phone" required>
                <?php if (isset($arResult["ERRORS"]["phone"])): ?>
                    <div class="input__notification"><?=$arResult["ERRORS"]["phone"]?></div>
                <?php endif; ?>
            </label>
        </div>
    </div>

    <div class="contact-form__form-message">
        <div class="input">
            <label class="input__label" for="medicine_message">
                <div class="input__label-text">Сообщение</div>
                <textarea class="input__input" id="medicine_message" name="medicine_message"></textarea>
            </label>
        </div>
    </div>

    <div class="contact-form__bottom">
        <div class="contact-form__bottom-policy">
            Нажимая &laquo;Отправить&raquo;, Вы подтверждаете, что ознакомлены, полностью согласны и принимаете условия &laquo;Согласия на обработку персональных данных&raquo;.
        </div>
        <button class="form-button contact-form__bottom-button" type="submit" data-success="Отправлено"
                data-error="Ошибка отправки">
            <div class="form-button__title">Оставить заявку</div>
        </button>
    </div>
</form>
