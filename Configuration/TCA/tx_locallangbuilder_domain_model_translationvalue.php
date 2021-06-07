<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:datamints_locallang_builder/Resources/Private/Language/locallang_db.xlf:tx_datamintslocallangbuilder_domain_model_translationvalue',
        'label' => 'ident',
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
        'searchFields' => 'ident,value,resname,xml_space,comment',
        'iconfile' => 'EXT:datamints_locallang_builder/Resources/Public/Icons/tx_datamintslocallangbuilder_domain_model_translationvalue.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, ident, value, resname, xml_space, approved, comment',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, ident, value, resname, xml_space, approved, comment, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
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
                'foreign_table' => 'tx_datamintslocallangbuilder_domain_model_translationvalue',
                'foreign_table_where' => 'AND {#tx_datamintslocallangbuilder_domain_model_translationvalue}.{#pid}=###CURRENT_PID### AND {#tx_datamintslocallangbuilder_domain_model_translationvalue}.{#sys_language_uid} IN (-1,0)',
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

        'ident' => [
            'exclude' => true,
            'label' => 'LLL:EXT:datamints_locallang_builder/Resources/Private/Language/locallang_db.xlf:tx_datamintslocallangbuilder_domain_model_translationvalue.ident',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'value' => [
            'exclude' => true,
            'label' => 'LLL:EXT:datamints_locallang_builder/Resources/Private/Language/locallang_db.xlf:tx_datamintslocallangbuilder_domain_model_translationvalue.value',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'resname' => [
            'exclude' => true,
            'label' => 'LLL:EXT:datamints_locallang_builder/Resources/Private/Language/locallang_db.xlf:tx_datamintslocallangbuilder_domain_model_translationvalue.resname',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'xml_space' => [
            'exclude' => true,
            'label' => 'LLL:EXT:datamints_locallang_builder/Resources/Private/Language/locallang_db.xlf:tx_datamintslocallangbuilder_domain_model_translationvalue.xml_space',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'approved' => [
            'exclude' => true,
            'label' => 'LLL:EXT:datamints_locallang_builder/Resources/Private/Language/locallang_db.xlf:tx_datamintslocallangbuilder_domain_model_translationvalue.approved',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
                    ]
                ],
                'default' => 0,
            ]
        ],
        'comment' => [
            'exclude' => true,
            'label' => 'LLL:EXT:datamints_locallang_builder/Resources/Private/Language/locallang_db.xlf:tx_datamintslocallangbuilder_domain_model_translationvalue.comment',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],

        'translation' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
