<?php

namespace Datamints\DatamintsLocallangBuilder\Service\Traits;

trait CachesServiceTrait
{
    /**
     * cacheService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Service\CachesService
     */
    protected $cachesService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Service\CachesService $cachesService
     */
    public function injectCachesService(\Datamints\DatamintsLocallangBuilder\Service\CachesService $cachesService)
    {
        $this->cachesService = $cachesService;
    }
}
