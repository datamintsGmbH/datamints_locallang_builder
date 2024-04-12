<?php

namespace Datamints\DatamintsLocallangBuilder\Service\Traits;

trait ManifestBuildServiceTrait
{
    /**
     * manifestBuildService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Service\ManifestBuildService
     */
    protected $manifestBuildService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Service\ManifestBuildService $manifestBuildService
     */
    public function injectManifestBuildService(\Datamints\DatamintsLocallangBuilder\Service\ManifestBuildService $manifestBuildService)
    {
        $this->manifestBuildService = $manifestBuildService;
    }
}
