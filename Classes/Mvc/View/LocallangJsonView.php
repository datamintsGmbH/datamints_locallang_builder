<?php

declare(strict_types=1);

namespace Datamints\DatamintsLocallangBuilder\Mvc\View;


class LocallangJsonView extends JsonView
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
                'filename',
                'translationsArray',
            ],
            '_descend' => [
                'translationsArray' => [
                    '_descendAll' => [
                        '_only' => [
                            'object',
                            'key',
                            '_showDetails'
                        ],
                        'object' => [
                            '_only' => [
                                'uid',
                                'expanded',
                                'translationKey',
                                'translationValues',
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
                        ]
                    ]

                ]

            ],
        ],
    ];
}
