<?php

declare(strict_types=1);

namespace Datamints\DatamintsLocallangBuilder\Mvc\View;


class ExtensionJsonView extends JsonView
{
    /**
     * Configuration to filter unwanted fields like 'path' for output to Vue
     *
     * @var array
     */
    protected $configuration = [
        'data' => [
            '_descendAll' => [
                '_only' => [
                    'uid',
                    'name',
                    'local',
                    'locallangs',

                ],
                '_descend' => [
                    'locallangs' => [],

                ],
            ],
        ],
    ];

    /**
     * Override to save output to cache
     *
     * @return array|mixed|string
     * @throws \TYPO3\CMS\Core\Cache\Exception\NoSuchCacheException
     */
    protected function renderArray()
    {
        $parentReturn = parent::renderArray();

        if(!$this->cachesService->has('extensionListResponse')) { // Add the response to cache ONLY if it doesnt exist, otherwise the fetches values are getting destroyed
            $this->cachesService->set('extensionListResponse', \json_encode($parentReturn, JSON_UNESCAPED_UNICODE));
        }
        return $parentReturn;
    }

}
