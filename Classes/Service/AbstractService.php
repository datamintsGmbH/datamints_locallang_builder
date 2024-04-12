<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Service;

use Datamints\DatamintsLocallangBuilder\Service\Traits\ConfigurationServiceTrait;
use TYPO3\CMS\Core\SingletonInterface;
use Datamints\DatamintsLocallangBuilder\Service\Configuration\ConfigurationService;
use Psr\Log\LoggerAwareTrait;

abstract class AbstractService implements SingletonInterface, \Psr\Log\LoggerAwareInterface
{
    use LoggerAwareTrait;
    use ConfigurationServiceTrait;



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
        return $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['datamints_locallang_builder'];
    }

}
