<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:datamints_locallang_builder/Resources/Private/Language/locallang_db.xlf:tx_datamintslocallangbuilder_domain_model_locallang',
        'label' => 'filename',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'sorting',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'filename,path',
        'iconfile' => 'EXT:datamints_locallang_builder/Resources/Public/Icons/tx_datamintslocallangbuilder_domain_model_locallang.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, filename, path, translations, related_extension',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, filename, path, translations, related_extension, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ]
                ],
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_datamintslocallangbuilder_domain_model_locallang',
                'foreign_table_where' => 'AND {#tx_datamintslocallangbuilder_domain_model_locallang}.{#pid}=###CURRENT_PID### AND {#tx_datamintslocallangbuilder_domain_model_locallang}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],

        'filename' => [
            'exclude' => true,
            'label' => 'LLL:EXT:datamints_locallang_builder/Resources/Private/Language/locallang_db.xlf:tx_datamintslocallangbuilder_domain_model_locallang.filename',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'path' => [
            'exclude' => true,
            'label' => 'LLL:EXT:datamints_locallang_builder/Resources/Private/Language/locallang_db.xlf:tx_datamintslocallangbuilder_domain_model_locallang.path',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'translations' => [
            'exclude' => true,
            'label' => 'LLL:EXT:datamints_locallang_builder/Resources/Private/Language/locallang_db.xlf:tx_datamintslocallangbuilder_domain_model_locallang.translations',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_datamintslocallangbuilder_domain_model_translation',
                'foreign_field' => 'locallang',
                'foreign_sortby' => 'sorting',
                'maxitems' => 9999,
                'appearance' => [
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'useSortable' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],

        ],
        'related_extension' => [
            'exclude' => true,
            'label' => 'LLL:EXT:datamints_locallang_builder/Resources/Private/Language/locallang_db.xlf:tx_datamintslocallangbuilder_domain_model_locallang.related_extension',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_datamintslocallangbuilder_domain_model_extension',
                'minitems' => 0,
                'maxitems' => 1,
                'appearance' => [
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],

        ],

        'extension' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
