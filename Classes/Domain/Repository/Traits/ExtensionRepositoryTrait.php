<?php

namespace Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits;

trait ExtensionRepositoryTrait
{
    /**
     * extensionRepository
     *
     * @var \Datamints\DatamintsLocallangBuilder\Domain\Repository\ExtensionRepository
     */
    protected $extensionRepository = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Repository\ExtensionRepository $ExtensionRepository
     */
    public function injectExtensionRepository(\Datamints\DatamintsLocallangBuilder\Domain\Repository\ExtensionRepository $extensionRepository)
    {
        $this->extensionRepository = $extensionRepository;
    }
}
