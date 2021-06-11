<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Services;

use Datamints\DatamintsLocallangBuilder\Provider\GoogleProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang;
use Datamints\DatamintsLocallangBuilder\Provider\AzureProvider;
use Datamints\DatamintsLocallangBuilder\Provider\DeeplProvider;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Translation;
use Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue;
use Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits\TranslationRepositoryTrait;
use Datamints\DatamintsLocallangBuilder\Services\Traits\ProviderServiceTrait;

class TranslationService extends AbstractService
{
    use TranslationRepositoryTrait;
    use ProviderServiceTrait;

    /**
     * @var \Datamints\DatamintsLocallangBuilder\Translation\Provider\AbstractProvider
     */
    protected $provider = null;

    public function __construct()
    {
        parent::__construct();


    }

    /**
     * Translates a TranslationValue by its DefaultValue
     *
     * @param TranslationValue $translationValue
     * @param string           $text
     *
     * @return array
     */
    public function translate(TranslationValue $translationValue, string $text): TranslationValue
    {
        if(!$this->provider) {
            $configuredProvider = $this->providerService->getConfiguredProvider();
            if($configuredProvider === 'AzureCloud') {
                $providerClass = AzureProvider::class;
            } else if($configuredProvider === 'DeepL') {
                $providerClass = DeeplProvider::class;
            } else if($configuredProvider === 'GoogleTranslate') {
                $providerClass = GoogleProvider::class;
            } else {
                throw new \TYPO3\CMS\Core\Exception('The configured Provider could not be found!');
            }
            $this->provider = GeneralUtility::makeInstance($providerClass);
        }
        $translationValue->setValue($this->provider->getTranslation($text, ['to' => $translationValue->getIdent()]));

        return $translationValue;
    }

    /**
     * Creates a new translation record based on givben values. One default-value is also included for "en"
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang
     * @param string                                                      $key
     * @param string                                                      $value
     * @param bool                                                        $approved
     * @param string                                                      $xmlSpace
     *
     * @return \Datamints\DatamintsLocallangBuilder\Domain\Model\Translation
     */
    public function createTranslation(Locallang $locallang, string $key, string $value, $approved = false, $xmlSpace = ""): Translation
    {
        /** @var Translation $newTranslation */
        $newTranslation = GeneralUtility::makeInstance(Translation::class);
        $newTranslation->setTranslationKey($key);
        $newTranslation->setExpanded(true); // we expand it straight with the response, so the user can see the new entity

        $locallang->addTranslation($newTranslation);

        // Its always required to add one default TranslationValue-Object ...
        /** @var TranslationValue $defaultTranslationValue */
        $defaultTranslationValue = $this->createTranslationValue($newTranslation, 'en');
        $defaultTranslationValue->setValue($value);
        $defaultTranslationValue->setApproved($approved);
        $defaultTranslationValue->setXmlSpace($xmlSpace);
        $defaultTranslationValue->setNew(true);
        $newTranslation->addTranslationValue($defaultTranslationValue);

        $locallang->addTranslation($newTranslation);


        return $newTranslation;
    }

    /**
     * creates a new translation value record based on given values and adds it to the given translation record
     *
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Translation $translation
     * @param string                                                        $ident
     * @param bool                                                          $approved
     * @param string                                                        $xmlSpace
     *
     * @return \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue
     */
    public function createTranslationValue(Translation $translation, string $ident, $approved = false, $xmlSpace = ""): TranslationValue
    {
        /** @var TranslationValue $newTranslationValue */
        $newTranslationValue = GeneralUtility::makeInstance(TranslationValue::class);
        $newTranslationValue->setIdent($ident);
        $newTranslationValue->setTstamp(new \DateTime());
        $newTranslationValue->setApproved($approved);
        $newTranslationValue->setXmlSpace($xmlSpace);

        $translation->addTranslationValue($newTranslationValue);


        return $newTranslationValue;
    }
}
