<?php

declare(strict_types=1);

namespace Datamints\DatamintsLocallangBuilder\Mvc\View;


class TranslationJsonView extends JsonView
{
    /**
     * Configuration to filter unwanted fields like 'path' for output to Vue
     *
     * @var array
     */
    protected $configuration = [
        'data' => [
            '_only' => [
                'uid',
                'translationKey',
                'translationValues',
                'expanded',
                'new',
            ],
            '_descend' => [
                'translationValues' => [
                    '_descendAll' => [
                        '_only' => [
                            'uid',
                            'ident',
                            'value',
                            'resname',
                            'xmlSpace',
                            'approved',
                            'tstamp',
                            'comment',
                        ]
                    ]
                ]

            ],
        ],
    ];
}
