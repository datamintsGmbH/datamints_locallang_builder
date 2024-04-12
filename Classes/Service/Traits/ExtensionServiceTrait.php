<?php

namespace Datamints\DatamintsLocallangBuilder\Service\Traits;

trait ExtensionServiceTrait
{
    /**
     * extensionService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Service\ExtensionService
     */
    protected $extensionService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Service\ExtensionService $extensionService
     */
    public function injectExtensionService(\Datamints\DatamintsLocallangBuilder\Service\ExtensionService $extensionService)
    {
        $this->extensionService = $extensionService;
    }
}
