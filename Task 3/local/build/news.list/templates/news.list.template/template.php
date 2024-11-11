<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php foreach ($arResult["ITEMS"] as $newsItem): ?>
    <div class="article-card">
        <div class="article-card__title">
            <a href="<?= $newsItem["DETAIL_PAGE_URL"] ?>">
                <?= $newsItem["NAME"] ?>
            </a>
        </div>
        <div class="article-card__date">
            <?= $newsItem["DISPLAY_ACTIVE_FROM"] ?>
        </div>
        <div class="article-card__content">
            <?php if ($newsItem["PREVIEW_PICTURE"]["SRC"]): ?>
                <div class="article-card__image sticky">
                    <img src="<?= $newsItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $newsItem["NAME"] ?>" data-object-fit="cover"/>
                </div>
            <?php endif; ?>
            <div class="article-card__text">
                <div class="block-content" data-anim="anim-3">
                    <p><?= $newsItem["PREVIEW_TEXT"] ?></p>
                </div>
                <a class="article-card__button" href="<?= $newsItem["DETAIL_PAGE_URL"] ?>">Подробнее</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>
