<?php

namespace Datamints\DatamintsLocallangBuilder\Services\Traits;

trait LocallangServiceTrait
{
    /**
     * locallangService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Services\LocallangService
     */
    protected $locallangService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Services\LocallangService $locallangService
     */
    public function injectLocallangService(\Datamints\DatamintsLocallangBuilder\Services\LocallangService $locallangService)
    {
        $this->locallangService = $locallangService;
    }
}
