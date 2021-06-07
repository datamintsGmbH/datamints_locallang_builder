<?php

namespace Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits;

trait TranslationValueRepositoryTrait
{
    /**
     * TranslationValueRepository
     *
     * @var \Datamints\DatamintsLocallangBuilder\Domain\Repository\TranslationValueRepository
     */
    protected $translationValueRepository = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Repository\TranslationValueRepository
     */
    public function injectTranslationValueRepository(\Datamints\DatamintsLocallangBuilder\Domain\Repository\TranslationValueRepository $translationValueRepository)
    {
        $this->translationValueRepository = $translationValueRepository;
    }
}
