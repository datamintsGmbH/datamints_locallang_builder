<?php
defined('TYPO3_MODE') || die();

call_user_func(static function () {

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Datamints.DatamintsLocallangBuilder',
        'tools', // Make module a submodule of 'tools'
        'translate', // Submodule key
        '', // Position
        [
            'Application' => 'main',
            'Extension' => 'list, update',
            'Translation' => 'list, update, delete, show, create',
            'TranslationValue' => 'update, delete, show, create, autoTranslate',
            'Locallang' => 'show, list, update, export',

        ],
        [
            'access' => 'user,group',
            'icon' => 'EXT:datamints_locallang_builder/Resources/Public/Icons/user_mod_translate.svg',
            'labels' => 'LLL:EXT:datamints_locallang_builder/Resources/Private/Language/locallang_translate.xlf',
        ]
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('datamints_locallang_builder', 'Configuration/TypoScript', 'datamints_locallang builder');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_locallangbuilder_domain_model_extension', 'EXT:datamints_locallang_builder/Resources/Private/Language/locallang_csh_tx_locallangbuilder_domain_model_extension.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_locallangbuilder_domain_model_extension');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_locallangbuilder_domain_model_locallang', 'EXT:datamints_locallang_builder/Resources/Private/Language/locallang_csh_tx_locallangbuilder_domain_model_locallang.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_locallangbuilder_domain_model_locallang');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_locallangbuilder_domain_model_translation', 'EXT:datamints_locallang_builder/Resources/Private/Language/locallang_csh_tx_locallangbuilder_domain_model_translation.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_locallangbuilder_domain_model_translation');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_locallangbuilder_domain_model_translationvalue', 'EXT:datamints_locallang_builder/Resources/Private/Language/locallang_csh_tx_locallangbuilder_domain_model_translationvalue.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_locallangbuilder_domain_model_translationvalue');

});
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
