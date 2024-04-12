<?php

namespace Datamints\DatamintsLocallangBuilder\Domain\Model;

use JsonSerializable;

/**
 * This file is part of the "datamints_locallang_builder" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 * Translation
 */
class Translation extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity implements JsonSerializable
{

    /**
     * Cache for default TranslationValue. Its calculated in runtime for faster access. Its not persisted in the DB!
     * Don't use this variable, instead use getDefaultTranslationValue()
     *
     * @var \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang
     */
    protected $defaultTranslationValueCache = null;

    /**
     * expandedFlag is controllable from server
     *
     * @var bool
     */
    protected bool $expanded = false;

    /**
     * new-flag to highlight in vue
     *
     * @var bool
     */
    protected bool $new = false;

    /**
     * translation key from the locallang.xlf-File
     *
     * @var string
     */
    protected string $translationKey = '';

    /**
     * TranslationValue as its written in the xlf-File
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $translationValues = null;

    /**
     * Bidirectional for easier db-queries
     *
     * @var \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $relatedLocallang = null;

    /**
     * __construct
     */
    public function __construct()
    {

        // Do not remove the next line: It would break the functionality
        $this->initializeObject();
    }

    /**
     * Initializes all ObjectStorage properties when model is reconstructed from DB (where __construct is not called)
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    public function initializeObject(): void
    {
        $this->translationValues = $this->translationValues ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Filtering json-output, if needed
     * To output all files, use return get_object_vars($this);
     */
    public function jsonSerialize()
    {
        return [
            'uid' => $this->getUid(),
            'translationKey' => $this->getTranslationKey(),
            'translationValues' => $this->getTranslationValuesArray(),
            'expanded' => $this->getExpanded(),
            'new' => $this->getNew()
        ];
    }

    /**
     * Returns the translationKey
     *
     * @return string translationKey
     */
    public function getTranslationKey()
    {
        return $this->translationKey;
    }

    /**
     * Sets the translationKey
     *
     * @param string $translationKey
     * @return void
     */
    public function setTranslationKey($translationKey)
    {
        $this->translationKey = $translationKey;
    }

    /**
     * Returns the default translation value. This value is calculated on demand and is not persisted
     *
     * @return \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValue
     */
    public function getDefaultTranslationValue()
    {
        if ($this->getDefaultTranslationValueCache()) {

            // Cache for faster access
            return $this->getDefaultTranslationValueCache();
        }
        foreach ($this->getTranslationValues() as $translationValue) {
            if ($translationValue->getIdent() == 'en') {
                $this->defaultTranslationValueCache = $translationValue;
                return $translationValue;
            }
        }
        return null;
    }

    /**
     * Get don't use this variable, instead use getDefaultTranslationValue()
     *
     * @return \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang
     */
    public function getDefaultTranslationValueCache()
    {
        return $this->defaultTranslationValueCache;
    }

    /**
     * Set don't use this variable, instead use getDefaultTranslationValue()
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $defaultTranslationValueCache Don't use this variable, instead use getDefaultTranslationValue()
     */
    public function setDefaultTranslationValueCache(\Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $defaultTranslationValueCache)
    {
        $this->defaultTranslationValueCache = $defaultTranslationValueCache;
    }

    /**
     * Returns the translationValues
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue> translationValues
     */
    public function getTranslationValues()
    {
        return $this->translationValues;
    }

    /**
     * Sets the translationValues
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue> $translationValues
     * @return void
     */
    public function setTranslationValues(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $translationValues)
    {
        $this->translationValues = $translationValues;
    }

    /**
     * Returns the relatedLocallang
     *
     * @return \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $relatedLocallang
     */
    public function getRelatedLocallang()
    {
        return $this->relatedLocallang;
    }

    /**
     * Sets the relatedLocallang
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $relatedLocallang
     * @return void
     */
    public function setRelatedLocallang(\Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $relatedLocallang)
    {
        $this->relatedLocallang = $relatedLocallang;
    }

    /**
     * Adds a TranslationValue
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValue
     * @return void
     */
    public function addTranslationValue(\Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValue)
    {
        $this->translationValues->attach($translationValue);
    }

    /**
     * Removes a TranslationValue
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValueToRemove The TranslationValue to be removed
     * @return void
     */
    public function removeTranslationValue(\Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValueToRemove)
    {
        $this->translationValues->detach($translationValueToRemove);
    }

    /**
     * Returns the translationValues
     * Somehow $this->translationValues->toArray() fetches an empty array when using the parent objects jsonSerialize-Function
     * @return array
     */
    public function getTranslationValuesArray()
    {
        $array = [];
        foreach ($this->translationValues as $translationValue){
            $array[md5($translationValue->getUid())] = $translationValue->jsonSerialize();
        }
        return $array;
    }

    /**
     * Get expandedFlag is controlable from server
     *
     * @return bool
     */
    public function getExpanded()
    {
        return $this->expanded;
    }

    /**
     * Set expandedFlag is controlable from server
     *
     * @param bool $expanded expandedFlag is controlable from server
     */
    public function setExpanded(bool $expanded)
    {
        $this->expanded = $expanded;
    }

    /**
     * Get new-flag to highlight in vue
     *
     * @return bool
     */
    public function getNew()
    {
        return $this->new;
    }

    /**
     * Set new-flag to highlight in vue
     *
     * @param bool $new new-flag to highlight in vue
     */
    public function setNew(bool $new)
    {
        $this->new = $new;
    }
}
