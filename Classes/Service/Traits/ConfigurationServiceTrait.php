<?php

namespace Datamints\DatamintsLocallangBuilder\Service\Traits;

trait ConfigurationServiceTrait
{
    /**
     * ConfigurationService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Service\Configuration\ConfigurationService
     */
    protected $ConfigurationService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Service\Configuration\ConfigurationService $ConfigurationService
     */
    public function injectConfigurationService(\Datamints\DatamintsLocallangBuilder\Service\Configuration\ConfigurationService $ConfigurationService)
    {
        $this->ConfigurationService = $ConfigurationService;
    }
}
