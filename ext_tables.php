<?php
defined('TYPO3') || die();

call_user_func(static function () {
    // not needed anymore because the typoscript is loaded always
    //\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('datamints_locallang_builder', 'Configuration/TypoScript', 'datamints Locallang Builder');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_datamintslocallangbuilder_domain_model_extension', 'EXT:datamints_locallang_builder/Resources/Private/Language/locallang_csh_tx_datamintslocallangbuilder_domain_model_extension.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_datamintslocallangbuilder_domain_model_extension');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_datamintslocallangbuilder_domain_model_locallang', 'EXT:datamints_locallang_builder/Resources/Private/Language/locallang_csh_tx_datamintslocallangbuilder_domain_model_locallang.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_datamintslocallangbuilder_domain_model_locallang');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_datamintslocallangbuilder_domain_model_translation', 'EXT:datamints_locallang_builder/Resources/Private/Language/locallang_csh_tx_datamintslocallangbuilder_domain_model_translation.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_datamintslocallangbuilder_domain_model_translation');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_datamintslocallangbuilder_domain_model_translationvalue', 'EXT:datamints_locallang_builder/Resources/Private/Language/locallang_csh_tx_datamintslocallangbuilder_domain_model_translationvalue.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_datamintslocallangbuilder_domain_model_translationvalue');
});
