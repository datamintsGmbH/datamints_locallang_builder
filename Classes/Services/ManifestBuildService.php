<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Services;

use DOMElement;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Extension;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang;
use Datamints\DatamintsLocallangBuilder\Utility\LanguageUtility;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Translation;

class ManifestBuildService extends AbstractService
{
    use \Datamints\DatamintsLocallangBuilder\Services\Traits\XmlServiceTrait;
    use \Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits\ExtensionRepositoryTrait;
    use \Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits\LocallangRepositoryTrait;

    const PERSIST = true;
    /**
     * Constant for relative path from extension-root to the language files to be scanned
     */
    const EXTENSION_LANGUAGE_PATH = "Resources/Private/Language/";

    /**
     *
     * @var \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang[]
     */
    protected $tempLocallangs = null;


    /**
     * Gets a Extension entity from db otherwise creates one new
     *
     * @param array $extensionDTO
     *
     * @return Extension
     */
    public function getExtensionPart(array $extensionDTO): ?Extension
    {
        if(is_null($extensionDTO) || !is_array($extensionDTO) || strlen($extensionDTO['key']) === 0) { // We dont throw an exception when there are invalid extensions
            return null;
        }

        // Check, if theres already one persisted entity. If so, return it. Otherwise create one, persist it (to get the uid) and return it
        $extensionEntity = $this->extensionRepository->findOneByName($extensionDTO['key'] ?? 'invalidname');
        if($extensionEntity) {
            return $extensionEntity;
        }
        return $this->createExtension($extensionDTO);
    }

    /**
     * Creates a new Extension and persists the entity. Also scans initially for locallang-files and creates references
     *
     * @param array $object
     *
     * @return Extension
     */
    protected function createExtension($object): Extension
    {
        /** @var Extension $extension */
        $extension = GeneralUtility::makeInstance(Extension::class);
        $extension->setName($object['key'] ?? 'unknown');
        $extension->setPath($object['path'] ?? 'unknown');
        $extension->setLocal($object['local'] ?? false);

        if($extension->isLocal()) { // we dont need locallang-files for non-local extensions, because those should be translated via translation manager
            $this->getDefaultLocallangPart($extension);
            // DatabaseUtility::persistAll(); // Required to get default Entities for this runtime
            $this->getCustomLocallangPart($extension);
        }

        if(self::PERSIST) {
            $this->extensionRepository->add($extension); // Subobjects are added recursively, so its the only needed directive to add something
        }
        return $extension;
    }

    /**
     * Creates locallang-entities for default-languages related to an extension. It wont check, if the entity is already existing, because extension entities are unique, so it shouldnt be possible for duplicates
     *
     * @param $extension Extension
     */
    protected function getDefaultLocallangPart(Extension $extension)
    {

        // First step is to create default-language related locallangs. We have to loop two times, to connect the custom language related stuff to the default language
        foreach ($this->findRelatedLocallangFiles($extension->getPath()) as $locallangFilePath) {
            if(LanguageUtility::isDefaultLanguageFile(pathinfo($locallangFilePath)['filename'])) {

                /** @var Locallang $locallang */
                $locallang = GeneralUtility::makeInstance(Locallang::class);
                $locallang->setFilename($locallangFilePath);
                $locallang->setPath($extension->getPath() . self::EXTENSION_LANGUAGE_PATH . $locallangFilePath);
                $locallang->setRelatedExtension($extension);
                $extension->addLocallang($locallang);

                $this->tempLocallangs[] = $locallang; // Adding it to temp locallang-cache, to loop through it in the next step, so the customLocallang can find its parent

                // Getting the translations / file content
                $this->getTranslationPart($locallang, $locallang->getPath());
            }
        }
    }

    /**
     * Finds related locallang files in the "Language"-Folder that belong to an extension
     *
     * @param string $extensionPath
     */
    protected function findRelatedLocallangFiles($extensionPath): array
    {
        if(!PathUtility::isAbsolutePath($extensionPath)) {
            $languageFullPath = $extensionPath . self::EXTENSION_LANGUAGE_PATH;
            return GeneralUtility::getFilesInDir(GeneralUtility::getFileAbsFileName(ltrim($languageFullPath, "./")));
        } else {
            return [];
        }
    }

    /**
     * Creates locallang-entities related to an extension. It wont check, if the entity is already existing, because extension entities are unique, so it shouldnt be possible for duplicates
     *
     * @param $extension Extension
     * @param $path      string
     */
    protected function getTranslationPart(Locallang $locallang, $path)
    {
        $path = GeneralUtility::getFileAbsFileName($path);
        /** @var DOMElement $fileDOM */
        $fileDOM = $this->xmlService->getXMLContentByLocallang($path, 'file');
        if(is_null($fileDOM) || !method_exists($fileDOM, 'getAttribute')) { // if we couldnt receive xml-content, the file could possibly be invalid or broken. In this case we skip this locallang
            $locallang->setInvalidFormat(true);
            return;
        }
        try {
            $targetLanguage = $fileDOM->getAttribute('target-language');
            $sourceLanguage = $fileDOM->getAttribute('source-language');
        } catch (Exception $e) {
            $locallang->setInvalidFormat(true);
            return;
        }
        $xmlContent = $this->xmlService->getXMLContentByLocallang($path, 'trans-unit');

        if(is_null($xmlContent)) { // if we couldnt receive xml-content, the file could possibly be invalid or broken. In this case we skip this locallang
            $locallang->setInvalidFormat(true);
            return;
        }

        if(is_a($xmlContent, DOMElement::class)) {
            $xmlContent = [$xmlContent];
        }
        /** @var DOMElement $domElement */
        foreach ($xmlContent as $domElement) {
            $isNew = true;
            // We take a look, if there already the same key registered
            foreach ($locallang->getTranslations() as $translation) {
                if($translation->getTranslationKey() === $domElement->getAttribute('id')) {
                    $isNew = false;
                    break;
                }
            }
            if($isNew) {
                /** @var Translation $translation */
                $translation = GeneralUtility::makeInstance(Translation::class);
                $translation->setTranslationKey($domElement->getAttribute('id'));
                $translation->setRelatedLocallang($locallang);
                $locallang->addTranslation($translation);
            }

            $translationValue = $this->xmlService->getTranslationValuePart($domElement);
            $translationValue->setIdent(strlen($targetLanguage) > 0 ? $targetLanguage : $sourceLanguage);
            $translation->addTranslationValue($translationValue);
        }
    }

    /**
     * Creates locallang-entities for not-default-languages related to an extension. It wont check, if the entity is already existing, because extension entities are unique, so it shouldnt be possible for duplicates
     *
     * @param $extension Extension
     */
    protected function getCustomLocallangPart(Extension $extension)
    {
        // Second step is to create custom-language related locallangs and connect them to their main-entity
        foreach ($this->findRelatedLocallangFiles($extension->getPath()) as $locallangFilePath) {
            $pathinfo = pathinfo($locallangFilePath);
            if(!LanguageUtility::isDefaultLanguageFile($pathinfo['filename'])) {
                foreach ($this->tempLocallangs as $tempLocallang) {
                    if(
                        $tempLocallang->getRelatedExtension() === $extension &&
                        $tempLocallang->getPath() === LanguageUtility::getDefaultLanguagePath($extension->getPath() . self::EXTENSION_LANGUAGE_PATH . $locallangFilePath)
                    ) {
                        $this->getTranslationPart($tempLocallang, $extension->getPath() . self::EXTENSION_LANGUAGE_PATH . $locallangFilePath);
                    }
                }


                // $this->getTranslationPart($locallang);
            }
        }
    }
}
