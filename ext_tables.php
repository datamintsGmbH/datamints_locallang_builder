<?php
defined('TYPO3_MODE') || die();

call_user_func(static function () {
    // We need a different initialization of the module depending on the TYPO3 version.
    $typo3Version = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Information\Typo3Version::class);
    if ($typo3Version->getMajorVersion() <= 10) {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
            'Datamints.DatamintsLocallangBuilder',
            'tools', // Make module a submodule of 'tools'
            'translate', // Submodule key
            '', // Position
            [
                'Application' => 'main,clear',
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
    } else {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
            'Datamints.DatamintsLocallangBuilder',
            'tools', // Make module a submodule of 'tools'
            'translate', // Submodule key
            '', // Position
            [
                \Datamints\DatamintsLocallangBuilder\Controller\ApplicationController::class => 'main,clear',
                \Datamints\DatamintsLocallangBuilder\Controller\ExtensionController::class => 'list, update',
                \Datamints\DatamintsLocallangBuilder\Controller\TranslationController::class => 'list, update, delete, show, create',
                \Datamints\DatamintsLocallangBuilder\Controller\TranslationValueController::class => 'update, delete, show, create, autoTranslate',
                \Datamints\DatamintsLocallangBuilder\Controller\LocallangController::class => 'show, list, update, export',

            ],
            [
                'access' => 'user,group',
                'icon' => 'EXT:datamints_locallang_builder/Resources/Public/Icons/user_mod_translate.svg',
                'labels' => 'LLL:EXT:datamints_locallang_builder/Resources/Private/Language/locallang_translate.xlf',
            ]
        );
    }

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('datamints_locallang_builder', 'Configuration/TypoScript', 'datamints Locallang Builder');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_datamintslocallangbuilder_domain_model_extension', 'EXT:datamints_locallang_builder/Resources/Private/Language/locallang_csh_tx_datamintslocallangbuilder_domain_model_extension.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_datamintslocallangbuilder_domain_model_extension');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_datamintslocallangbuilder_domain_model_locallang', 'EXT:datamints_locallang_builder/Resources/Private/Language/locallang_csh_tx_datamintslocallangbuilder_domain_model_locallang.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_datamintslocallangbuilder_domain_model_locallang');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_datamintslocallangbuilder_domain_model_translation', 'EXT:datamints_locallang_builder/Resources/Private/Language/locallang_csh_tx_datamintslocallangbuilder_domain_model_translation.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_datamintslocallangbuilder_domain_model_translation');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_datamintslocallangbuilder_domain_model_translationvalue', 'EXT:datamints_locallang_builder/Resources/Private/Language/locallang_csh_tx_datamintslocallangbuilder_domain_model_translationvalue.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_datamintslocallangbuilder_domain_model_translationvalue');

    // We need to use a different controller for different TYPO3 versions as the method signature has changed.
    /** @var $extbaseObjectContainer \TYPO3\CMS\Extbase\Object\Container\Container */
    $extbaseObjectContainer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\Container\Container::class);
    if ($typo3Version->getMajorVersion() <= 10) {
        $extbaseObjectContainer->registerImplementation(
            \Datamints\DatamintsLocallangBuilder\Controller\ApplicationController::class,
            \Datamints\DatamintsLocallangBuilder\Controller\ApplicationLegacyController::class
        );
        $extbaseObjectContainer->registerImplementation(
            \Datamints\DatamintsLocallangBuilder\Controller\ExtensionController::class,
            \Datamints\DatamintsLocallangBuilder\Controller\ExtensionLegacyController::class
        );
        $extbaseObjectContainer->registerImplementation(
            \Datamints\DatamintsLocallangBuilder\Controller\LocallangController::class,
            \Datamints\DatamintsLocallangBuilder\Controller\LocallangLegacyController::class
        );
        $extbaseObjectContainer->registerImplementation(
            \Datamints\DatamintsLocallangBuilder\Controller\TranslationController::class,
            \Datamints\DatamintsLocallangBuilder\Controller\TranslationLegacyController::class
        );
        $extbaseObjectContainer->registerImplementation(
            \Datamints\DatamintsLocallangBuilder\Controller\TranslationValueController::class,
            \Datamints\DatamintsLocallangBuilder\Controller\TranslationValueLegacyController::class
        );
    } else {
        $extbaseObjectContainer->registerImplementation(
            \Datamints\DatamintsLocallangBuilder\Controller\ApplicationController::class,
            \Datamints\DatamintsLocallangBuilder\Controller\ApplicationCurrentController::class
        );
        $extbaseObjectContainer->registerImplementation(
            \Datamints\DatamintsLocallangBuilder\Controller\ExtensionController::class,
            \Datamints\DatamintsLocallangBuilder\Controller\ExtensionCurrentController::class
        );
        $extbaseObjectContainer->registerImplementation(
            \Datamints\DatamintsLocallangBuilder\Controller\LocallangController::class,
            \Datamints\DatamintsLocallangBuilder\Controller\LocallangCurrentController::class
        );
        $extbaseObjectContainer->registerImplementation(
            \Datamints\DatamintsLocallangBuilder\Controller\TranslationController::class,
            \Datamints\DatamintsLocallangBuilder\Controller\TranslationCurrentController::class
        );
        $extbaseObjectContainer->registerImplementation(
            \Datamints\DatamintsLocallangBuilder\Controller\TranslationValueController::class,
            \Datamints\DatamintsLocallangBuilder\Controller\TranslationValueCurrentController::class
        );
    }
});
