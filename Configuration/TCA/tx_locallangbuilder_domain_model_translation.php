<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:datamints_locallang_builder/Resources/Private/Language/locallang_db.xlf:tx_datamintslocallangbuilder_domain_model_translation',
        'label' => 'translation_key',
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
        'searchFields' => 'translation_key',
        'iconfile' => 'EXT:datamints_locallang_builder/Resources/Public/Icons/tx_datamintslocallangbuilder_domain_model_translation.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, translation_key, translation_values, related_locallang',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, translation_key, translation_values, related_locallang, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
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
                'foreign_table' => 'tx_datamintslocallangbuilder_domain_model_translation',
                'foreign_table_where' => 'AND {#tx_datamintslocallangbuilder_domain_model_translation}.{#pid}=###CURRENT_PID### AND {#tx_datamintslocallangbuilder_domain_model_translation}.{#sys_language_uid} IN (-1,0)',
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

        'translation_key' => [
            'exclude' => true,
            'label' => 'LLL:EXT:datamints_locallang_builder/Resources/Private/Language/locallang_db.xlf:tx_datamintslocallangbuilder_domain_model_translation.translation_key',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'translation_values' => [
            'exclude' => true,
            'label' => 'LLL:EXT:datamints_locallang_builder/Resources/Private/Language/locallang_db.xlf:tx_datamintslocallangbuilder_domain_model_translation.translation_values',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_datamintslocallangbuilder_domain_model_translationvalue',
                'foreign_field' => 'translation',
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
        'related_locallang' => [
            'exclude' => true,
            'label' => 'LLL:EXT:datamints_locallang_builder/Resources/Private/Language/locallang_db.xlf:tx_datamintslocallangbuilder_domain_model_translation.related_locallang',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_datamintslocallangbuilder_domain_model_locallang',
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

        'locallang' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
