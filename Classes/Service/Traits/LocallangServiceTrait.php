<?php

namespace Datamints\DatamintsLocallangBuilder\Service\Traits;

trait LocallangServiceTrait
{
    /**
     * locallangService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Service\LocallangService
     */
    protected $locallangService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Service\LocallangService $locallangService
     */
    public function injectLocallangService(\Datamints\DatamintsLocallangBuilder\Service\LocallangService $locallangService)
    {
        $this->locallangService = $locallangService;
    }
}
