<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="my-news-list">
    <?php if (!empty($arResult['ITEMS'])): ?>
        <?php foreach ($arResult['ITEMS'] as $iblockId => $items): ?>
            <div class="news-group">
                <h2>Инфоблок ID: <?= htmlspecialchars($iblockId) ?></h2>
                <ul class="news-list">
                    <?php foreach ($items as $item): ?>
                        <li class="news-item">
                            <a href="<?= htmlspecialchars($item['DETAIL_PAGE_URL']) ?>" class="news-link">
                                <?= htmlspecialchars($item['NAME']) ?>
                            </a>
                            <?php if ($arParams["SHOW_PREVIEW_TEXT"] === "Y" && !empty($item['PREVIEW_TEXT'])): ?>
                                <p class="news-preview-text">
                                    <?= htmlspecialchars($item['PREVIEW_TEXT']) ?>
                                </p>
                            <?php endif; ?>
                            <?php if ($arParams["SHOW_PREVIEW_PICTURE"] === "Y" && !empty($item['PREVIEW_PICTURE'])): ?>
                                <img
                                        src="<?= htmlspecialchars(CFile::GetPath($item['PREVIEW_PICTURE'])) ?>"
                                        alt="<?= htmlspecialchars($item['NAME']) ?>"
                                        class="news-preview-image"
                                >
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Нет элементов для отображения.</p>
    <?php endif; ?>
</div>
