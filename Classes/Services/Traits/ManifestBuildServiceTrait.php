<?php

namespace Datamints\DatamintsLocallangBuilder\Services\Traits;

trait ManifestBuildServiceTrait
{
    /**
     * manifestBuildService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Services\ManifestBuildService
     */
    protected $manifestBuildService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Services\ManifestBuildService $manifestBuildService
     */
    public function injectManifestBuildService(\Datamints\DatamintsLocallangBuilder\Services\ManifestBuildService $manifestBuildService)
    {
        $this->manifestBuildService = $manifestBuildService;
    }
}
