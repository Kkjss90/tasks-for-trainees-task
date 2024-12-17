<?php

use Bitrix\Main\ModuleManager;
use Bitrix\Main\EventManager;

class my_module extends CModule
{
    var $MODULE_ID  = 'my.module';

    function __construct()
    {
        $arModuleVersion = array();
        include __DIR__ . '/version.php';

        $this->MODULE_ID = 'my.module';
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        $this->MODULE_NAME = Loc::getMessage('IEX_CPROP_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('IEX_CPROP_MODULE_DESC');
        $this->PARTNER_NAME = Loc::getMessage('IEX_CPROP_PARTNER_NAME');
        $this->FILE_PREFIX = 'cprop';
        $this->FOLDER = 'bitrix';
    }

    public function DoInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);

        $eventManager = EventManager::getInstance();
        $eventManager->registerEventHandler(
            'iblock',
            'OnIBlockPropertyBuildList',
            $this->MODULE_ID,
            '\\My\\Module\\ComplexProperty',
            'GetUserTypeDescription'
        );

        $eventManager->registerEventHandler(
            'main',
            'OnUserTypeBuildList',
            $this->MODULE_ID,
            '\\My\\Module\\UserFieldComplexProperty',
            'GetUserTypeDescription'
        );
    }

    public function DoUninstall()
    {
        $eventManager = EventManager::getInstance();
        $eventManager->unRegisterEventHandler(
            'iblock',
            'OnIBlockPropertyBuildList',
            $this->MODULE_ID,
            '\\My\\Module\\ComplexProperty',
            'GetUserTypeDescription'
        );

        $eventManager->unRegisterEventHandler(
            'main',
            'OnUserTypeBuildList',
            $this->MODULE_ID,
            '\\My\\Module\\UserFieldComplexProperty',
            'GetUserTypeDescription'
        );

        ModuleManager::unRegisterModule($this->MODULE_ID);
    }
}
