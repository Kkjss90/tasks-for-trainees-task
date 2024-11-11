<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Новости</title>
    <link rel="shortcut icon" href="images/favicon.604825ed.ico" type="image/x-icon">
    <link href="css/common.css" rel="stylesheet">
</head>
<body>

<div class="content-wrapper">
    <?php
    $isDetailPage = $arResult["VARIABLES"]["ELEMENT_ID"] || $arResult["VARIABLES"]["ELEMENT_CODE"];
    $isSectionPage = $arResult["VARIABLES"]["SECTION_ID"] || $arResult["VARIABLES"]["SECTION_CODE"];

    if ($isDetailPage) {
        include("news.detail.php");
    } elseif ($isSectionPage) {
        include("news.sections.php");
    } else {
        include("news.list.php");
    }
    ?>
</div>

</body>
</html>
