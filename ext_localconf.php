<?php

use TYPO3\CMS\Core\Http\ApplicationType;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') || die();

// Using own cache (DB-Based)
if (empty($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['datamintslocallangbuilder_cache'])) {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['datamintslocallangbuilder_cache'] = [];
}
// always include typoscript
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript(
    'datamints_locallang_builder',
    'constants',
    "@import 'EXT:datamints_locallang_builder/Configuration/TypoScript/constants.typoscript'"
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript(
    'datamints_locallang_builder',
    'setup',
    "@import 'EXT:datamints_locallang_builder/Configuration/TypoScript/setup.typoscript'"
);

// Using typo3 logging
$GLOBALS['TYPO3_CONF_VARS']['LOG']['Datamints']['DatamintsLocallangBuilder']['writerConfiguration'] = [
    \TYPO3\CMS\Core\Log\LogLevel::INFO => [
        \TYPO3\CMS\Core\Log\Writer\FileWriter::class => [
            'logFile' => \TYPO3\CMS\Core\Core\Environment::getVarPath() . '/log/datamints_locallang_builder.log',
        ],
    ],
    \TYPO3\CMS\Core\Log\LogLevel::ERROR => [
        \TYPO3\CMS\Core\Log\Writer\FileWriter::class => [
            'logFile' => \TYPO3\CMS\Core\Core\Environment::getVarPath() . '/log/datamints_locallang_builder_critical.log',
        ],
    ],
];
$GLOBALS['TYPO3_CONF_VARS']['LOG']['Datamints']['DatamintsLocallangBuilder']['processorConfiguration'] = [
    \TYPO3\CMS\Core\Log\LogLevel::INFO => [
        \Datamints\DatamintsLocallangBuilder\Log\Processor\BackendUserProcessor::class => [],
    ],
    \TYPO3\CMS\Core\Log\LogLevel::ERROR => [
        \Datamints\DatamintsLocallangBuilder\Log\Processor\BackendUserProcessor::class => [],
    ],
];




