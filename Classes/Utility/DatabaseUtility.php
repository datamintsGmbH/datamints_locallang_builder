<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de)
 */

namespace Datamints\DatamintsLocallangBuilder\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

class DatabaseUtility
{
    /**
     * persist all unpersisted stuff
     */
    public static function persistAll(): void
    {
        $persistanceManager = GeneralUtility::makeInstance(PersistenceManager::class);
        $persistanceManager->persistAll();
    }
}
