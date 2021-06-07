<?php

namespace Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits;

trait LocallangRepositoryTrait
{
    /**
     * locallangRepository
     *
     * @var \Datamints\DatamintsLocallangBuilder\Domain\Repository\LocallangRepository
     */
    protected $locallangRepository = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Repository\LocallangRepository $LocallangRepository
     */
    public function injectLocallangRepository(\Datamints\DatamintsLocallangBuilder\Domain\Repository\LocallangRepository $locallangRepository)
    {
        $this->locallangRepository = $locallangRepository;
    }
}
