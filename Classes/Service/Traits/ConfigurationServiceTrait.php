<?php

namespace Datamints\DatamintsLocallangBuilder\Service\Traits;

trait ConfigurationServiceTrait
{
    /**
     * ConfigurationService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Service\Configuration\ConfigurationService
     */
    protected $configurationService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Service\Configuration\ConfigurationService $configurationService
     */
    public function injectConfigurationService(\Datamints\DatamintsLocallangBuilder\Service\Configuration\ConfigurationService $configurationService)
    {
        $this->configurationService = $configurationService;
    }
}
