<?php
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
            \Datamints\DatamintsLocallangBuilder\Controller\ApplicationController::class => [
                'main','clear'
            ],
            \Datamints\DatamintsLocallangBuilder\Controller\ExtensionController::class => [
                'list', 'update'
            ],
            \Datamints\DatamintsLocallangBuilder\Controller\TranslationController::class => [
                'list', 'update', 'delete', 'show', 'create'
            ],
            \Datamints\DatamintsLocallangBuilder\Controller\TranslationValueController::class => [
                'update', 'delete', 'show', 'create', 'autoTranslate'
            ],
            \Datamints\DatamintsLocallangBuilder\Controller\LocallangController::class => [
                'show', 'list', 'update', 'export'
            ]
        ],
    ],
];
