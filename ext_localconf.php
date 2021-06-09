<?php

defined('TYPO3_MODE') || die();

// Adding symphony-support for TYPO3 9.x without composer-mode
if(substr(TYPO3_version, 0, 1) == "9") {
    require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('datamints_locallang_builder', 'Resources/Private/DependenciesLegacy/vendor/autoload.php');
}
// Adding other libs that are defined in a seperate composer-file, to gain access for non-composer-instances. Currently not necessary
//require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('datamints_locallang_builder', 'Resources/Private/Dependencies/vendor/autoload.php');

// Using own cache (DB-Based)
if(!is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['datamintslocallangbuilder_cache'])) {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['datamintslocallangbuilder_cache'] = [];
}

