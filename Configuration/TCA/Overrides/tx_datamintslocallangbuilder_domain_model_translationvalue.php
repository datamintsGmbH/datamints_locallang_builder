<?php

$GLOBALS['TCA']['tx_datamintslocallangbuilder_domain_model_translationvalue']['columns']['tstamp'] = [
    'label' => 'tstamp',
    'config' => [
        'type' => 'passthrough',
    ],
];
// Hide table in list view
$GLOBALS['TCA']['tx_datamintslocallangbuilder_domain_model_translationvalue']['ctrl']['hideTable'] = 1;
