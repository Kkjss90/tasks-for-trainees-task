<?php

use Bitrix\Main\EventManager;
use Bitrix\Main\Loader;

Loader::includeModule('iblock');

require_once __DIR__ . '/handlers/iblock.php';

require_once __DIR__ . '/agents/iblock.php';

EventManager::getInstance()->addEventHandler(
    'iblock',
    'OnAfterIBlockElementAdd',
    ['Only\Site\Handlers\Iblock', 'addLog']
);

EventManager::getInstance()->addEventHandler(
    'iblock',
    'OnAfterIBlockElementUpdate',
    ['Only\Site\Handlers\Iblock', 'addLog']
);

if (!\CAgent::GetList([], ['NAME' => '\\Only\\Site\\Agents\\Iblock::clearOldLogs();'])->Fetch()) {
    \CAgent::AddAgent(
        '\\Only\\Site\\Agents\\Iblock::clearOldLogs();',
        '', // Модуль, пустой для выполнения в PHP
        'N', // Выполнять только через CRON
        3600, // Интервал выполнения: раз в час
        '', // Дата первого запуска
        'Y', // Агент активен
        '', // Не указываем конкретное время запуска
        30 // Приоритет
    );
}
