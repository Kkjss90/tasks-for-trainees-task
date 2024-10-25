<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div id="barba-wrapper">
    <div class="article-list">
        <div class="news-list">
            <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                <?php
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), ["CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]);
                ?>
                <div class="news-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <?php if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                            <img
                                    src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                    width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                                    height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                                    alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                    title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                                    class="news-item__image"
                            />
                        </a>
                    <?php endif; ?>

                    <div class="news-item__content">
                        <?php if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
                            <div class="news-item__title">
                                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?= $arItem["NAME"] ?></a>
                            </div>
                        <?php endif; ?>

                        <?php if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                            <div class="news-item__text"><?= $arItem["PREVIEW_TEXT"]; ?></div>
                        <?php endif; ?>

                        <?php if ($arParams["DISPLAY_DATE"] != "N" && $arItem["DISPLAY_ACTIVE_FROM"]): ?>
                            <div class="news-item__date"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
                <div class="news-pagination"><?= $arResult["NAV_STRING"] ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>