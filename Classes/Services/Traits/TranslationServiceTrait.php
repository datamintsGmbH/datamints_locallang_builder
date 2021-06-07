<?php

namespace Datamints\DatamintsLocallangBuilder\Services\Traits;

trait TranslationServiceTrait
{
    /**
     * translationService
     *
     * @var \Datamints\DatamintsLocallangBuilder\Services\TranslationService
     */
    protected $translationService = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Services\TranslationService $translationService
     */
    public function injectTranslationService(\Datamints\DatamintsLocallangBuilder\Services\TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }
}
