<?php

namespace Datamints\DatamintsLocallangBuilder\Domain\Model;

use JsonSerializable;

/**
 * This file is part of the "datamints_locallang_builder" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 * Locallang
 */
class Locallang extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity implements JsonSerializable
{

    /**
     * filename
     *
     * @var string
     */
    protected $filename = '';

    /**
     * path from extension root
     *
     * @var string
     */
    protected $path = '';

    /**
     * Flag when the scan cant fetch it's data, because theres something wrong with it
     *
     * @var bool
     */
    protected $invalidFormat = false;

    /**
     * translations
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Datamints\DatamintsLocallangBuilder\Domain\Model\Translation>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $translations = null;

    /**
     * Bidirectional for easier db-queries
     *
     * @var \Datamints\DatamintsLocallangBuilder\Domain\Model\Extension
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $relatedExtension = null;

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
    public function initializeObject()
    {
        $this->translations = $this->translations ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the path
     *
     * @return string path
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Sets the path
     *
     * @param string $path
     *
     * @return void
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Adds a Translation
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Translation $translation
     *
     * @return void
     */
    public function addTranslation(\Datamints\DatamintsLocallangBuilder\Domain\Model\Translation $translation)
    {
        $this->translations->attach($translation);
    }

    /**
     * Removes a Translation
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Translation $translationToRemove The Translation to be removed
     *
     * @return void
     */
    public function removeTranslation(\Datamints\DatamintsLocallangBuilder\Domain\Model\Translation $translationToRemove)
    {
        $this->translations->detach($translationToRemove);
    }

    /**
     * Returns the translations
     *
     * @return array
     */
    public function getTranslationsArray()
    {

        // Creating wrapper-object for vue-table-usage, so we dont have to map some data in vue
        return array_map(
            function ($object) {
                return [
                    'object' => $object,
                    'key' => $object->getTranslationKey(),
                    '_showDetails' => true,
                ];
            },
            $this->translations->toArray()
        );
    }

    /**
     * Filtering json-output, if needed
     * To output all files, use return get_object_vars($this);
     */
    public function jsonSerialize()
    {
        return [
            'uid' => $this->getUid(),
            'filename' => $this->getFilename(),
            'translations' => $this->getTranslations()->toArray(),
        ];
    }

    /**
     * Returns the filename
     *
     * @return string filename
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Sets the filename
     *
     * @param string $filename
     *
     * @return void
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Returns the translations
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Datamints\DatamintsLocallangBuilder\Domain\Model\Translation> translations
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * Sets the translations
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Datamints\DatamintsLocallangBuilder\Domain\Model\Translation> $translations
     *
     * @return void
     */
    public function setTranslations(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $translations)
    {
        $this->translations = $translations;
    }

    /**
     * Returns the relatedExtension
     *
     * @return \Datamints\DatamintsLocallangBuilder\Domain\Model\Extension $relatedExtension
     */
    public function getRelatedExtension()
    {
        return $this->relatedExtension;
    }

    /**
     * Sets the relatedExtension
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Extension $relatedExtension
     *
     * @return void
     */
    public function setRelatedExtension(\Datamints\DatamintsLocallangBuilder\Domain\Model\Extension $relatedExtension)
    {
        $this->relatedExtension = $relatedExtension;
    }

    /**
     * Returns the boolean state of invalidFormat
     *
     * @return bool
     */
    public function isInvalidFormat()
    {
        return $this->invalidFormat;
    }

    /**
     * Returns the invalidFormat
     *
     * @return bool $invalidFormat
     */
    public function getInvalidFormat()
    {
        return $this->invalidFormat;
    }

    /**
     * Sets the invalidFormat
     *
     * @param bool $invalidFormat
     *
     * @return void
     */
    public function setInvalidFormat($invalidFormat)
    {
        $this->invalidFormat = $invalidFormat;
    }
}
