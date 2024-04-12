<?php

use Datamints\DatamintsLocallangBuilder\Controller\{ApplicationController,
    ExtensionController,
    LocallangController,
    TranslationController,
    TranslationValueController};

return [
    'web_DatamintsLocallangBuilderTranslate' => [
        'parent' => 'web',
        'position' => ['before' => '*'],
        'access' => 'user',
        'workspaces' => 'live',
        'inheritNavigationComponentFromMainModule' => false,
        'iconIdentifier' => 'module-datamints-locallang-builder-translate',
        'path' => '/module/web/Datamints.DatamintsLocallangBuilderTranslate',
        'labels' => 'LLL:EXT:datamints_locallang_builder/Resources/Private/Language/locallang_translate.xlf',
        'extensionName' => 'DatamintsLocallangBuilder',
        'controllerActions' => [
            ApplicationController::class => [
                'main','clear'
            ],
            ExtensionController::class => [
                'list', 'update'
            ],
            TranslationController::class => [
                'list', 'update', 'delete', 'show', 'create'
            ],
            TranslationValueController::class => [
                'update', 'delete', 'show', 'create', 'autoTranslate'
            ],
            LocallangController::class => [
                'show', 'list', 'update', 'export'
            ]
        ],
    ],
];
