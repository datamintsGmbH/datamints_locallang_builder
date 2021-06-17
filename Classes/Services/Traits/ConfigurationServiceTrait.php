<?php

namespace Datamints\DatamintsLocallangBuilder\Services\Traits;

trait ConfigurationServiceTrait
{
    /**
     * ConfigurationService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Services\Configuration\ConfigurationService
     */
    protected $ConfigurationService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Services\Configuration\ConfigurationService $ConfigurationService
     */
    public function injectConfigurationService(\Datamints\DatamintsLocallangBuilder\Services\Configuration\ConfigurationService $ConfigurationService)
    {
        $this->ConfigurationService = $ConfigurationService;
    }
}
