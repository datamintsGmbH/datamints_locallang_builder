<?php

namespace Datamints\DatamintsLocallangBuilder\Service\Traits;

trait TranslationServiceTrait
{
    /**
     * translationService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Service\TranslationService
     */
    protected $translationService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Service\TranslationService $translationService
     */
    public function injectTranslationService(\Datamints\DatamintsLocallangBuilder\Service\TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }
}
