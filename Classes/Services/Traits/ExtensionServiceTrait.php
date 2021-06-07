<?php

namespace Datamints\DatamintsLocallangBuilder\Services\Traits;

trait ExtensionServiceTrait
{
    /**
     * extensionService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Services\ExtensionService
     */
    protected $extensionService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Services\ExtensionService $extensionService
     */
    public function injectExtensionService(\Datamints\DatamintsLocallangBuilder\Services\ExtensionService $extensionService)
    {
        $this->extensionService = $extensionService;
    }
}
