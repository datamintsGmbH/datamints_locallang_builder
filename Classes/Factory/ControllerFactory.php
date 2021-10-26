<?php

namespace Datamints\DatamintsLocallangBuilder\Factory;

class ControllerFactory
{
    public static function createApplicationController(): \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
    {
        /** @var \TYPO3\CMS\Core\Information\Typo3Version $typo3Version */
        $typo3Version = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Information\Typo3Version::class);
        if($typo3Version->getMajorVersion() <= 10) {
            return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Datamints\DatamintsLocallangBuilder\Controller\ApplicationLegacyController::class);
        } else {
            return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Datamints\DatamintsLocallangBuilder\Controller\ApplicationCurrentController::class);
        }
    }
}
