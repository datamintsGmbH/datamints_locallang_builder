<?php

namespace Datamints\DatamintsLocallangBuilder\Service\Traits;

trait ProviderServiceTrait
{
    /**
     * providerService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Service\ProviderService
     */
    protected $providerService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Service\ProviderService $providerService
     */
    public function injectProviderService(\Datamints\DatamintsLocallangBuilder\Service\ProviderService $providerService)
    {
        $this->providerService = $providerService;
    }
}
