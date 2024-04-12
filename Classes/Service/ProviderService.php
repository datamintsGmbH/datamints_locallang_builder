<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class ProviderService extends AbstractService
{

    /**
     * Gets the translation service provider that is configured in typoscript
     *
     * @return string
     */
    public function getConfiguredProvider(): string
    {
        return $this->getExtensionConfig()['activeProvider'];
    }
}
