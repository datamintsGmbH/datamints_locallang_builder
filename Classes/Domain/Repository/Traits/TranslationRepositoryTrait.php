<?php

namespace Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits;

trait TranslationRepositoryTrait
{
    /**
     * TranslationRepository
     *
     * @var \Datamints\DatamintsLocallangBuilder\Domain\Repository\TranslationRepository
     */
    protected $translationRepository = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Repository\TranslationRepository
     */
    public function injectTranslationRepository(\Datamints\DatamintsLocallangBuilder\Domain\Repository\TranslationRepository $translationRepository)
    {
        $this->translationRepository = $translationRepository;
    }
}
