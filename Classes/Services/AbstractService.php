<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de)
 */

namespace Datamints\DatamintsLocallangBuilder\Services;

use TYPO3\CMS\Core\SingletonInterface;
use Datamints\DatamintsLocallangBuilder\Services\Configuration\ConfigurationService;

abstract class AbstractService implements SingletonInterface
{

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var ConfigurationService
     */
    protected $configurationService;

    public function __construct()
    {
        $this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
        $this->configurationService = $this->objectManager->get(ConfigurationService::class);
    }

    /**
     * Liefert das TS der Extension
     *
     * @return array
     */
    public function getSettings()
    {
        return $this->configurationService->getSettings();
    }

    /**
     * Liefert die ExtensionConfig
     *
     * @return array
     */
    public function getExtensionConfig()
    {
        return unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['datamints_locallang_builder']);
    }

    /**
     * @return ConfigurationManagerInterface
     */
    public function getConfigurationManager()
    {
        return $this->objectManager->get(ConfigurationManagerInterface::class);
    }
}
