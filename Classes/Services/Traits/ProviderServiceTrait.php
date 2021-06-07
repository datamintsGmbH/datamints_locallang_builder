<?php

namespace Datamints\DatamintsLocallangBuilder\Services\Traits;

trait ProviderServiceTrait
{
    /**
     * providerService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Services\ProviderService
     */
    protected $providerService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Services\ProviderService $providerService
     */
    public function injectProviderService(\Datamints\DatamintsLocallangBuilder\Services\ProviderService $providerService)
    {
        $this->providerService = $providerService;
    }
}
