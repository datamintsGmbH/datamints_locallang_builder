<?php

namespace Datamints\DatamintsLocallangBuilder\Services\Traits;

trait CachesServiceTrait
{
    /**
     * cacheService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Services\CachesService
     */
    protected $cachesService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Services\CachesService $cachesService
     */
    public function injectCachesService(\Datamints\DatamintsLocallangBuilder\Services\CachesService $cachesService)
    {
        $this->cachesService = $cachesService;
    }
}
