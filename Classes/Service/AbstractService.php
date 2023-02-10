<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Service;

use TYPO3\CMS\Core\SingletonInterface;
use Datamints\DatamintsLocallangBuilder\Service\Configuration\ConfigurationService;
use Psr\Log\LoggerAwareTrait;

abstract class AbstractService implements SingletonInterface, \Psr\Log\LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     */
    protected $objectManager;


    public function __construct(
        protected readonly ConfigurationService $configurationService,
    )
    {
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
