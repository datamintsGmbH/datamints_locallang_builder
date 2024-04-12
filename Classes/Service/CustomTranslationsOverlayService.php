<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Service;

use Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Runtime\LocallangExport;
use Datamints\DatamintsLocallangBuilder\Exporter\XmlExporter;
use Datamints\DatamintsLocallangBuilder\Service\Traits\ConfigurationServiceTrait;
use Datamints\DatamintsLocallangBuilder\Service\Traits\LocallangServiceTrait;
use Datamints\DatamintsLocallangBuilder\Service\Traits\XmlServiceTrait;
use Datamints\DatamintsLocallangBuilder\Utility\LanguageUtility;
use TYPO3\CMS\Core\Exception;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class CustomTranslationsOverlayService extends AbstractService
{
    /**
     * Overwrites the path for custom translations that have been overwritten by an extension.
     * See: https://docs.typo3.org/m/typo3/reference-coreapi/12.4/en-us/ApiOverview/Localization/ManagingTranslations.html?highlight=locallangxmloverride#custom-translations
     *
     * Beware!! currently we only accept ONE override. When multiple values are given we'll choose the first in the list!
     * @param string $path
     * @return string
     */
    public function setOverlay(string $path): string
    {
        foreach ($GLOBALS['TYPO3_CONF_VARS']['SYS']['locallangXMLOverride'] as $locallangXMLOverridePath => $locallangXMLOverrides){
            if($locallangXMLOverridePath === $path){
                return $locallangXMLOverrides[0];
            }

        }
        // passthrough the original given value if no override matches
        return $path;
    }
}
