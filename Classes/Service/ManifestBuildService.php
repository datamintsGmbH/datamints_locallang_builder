<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Service;

use Exception;
use Datamints\DatamintsLocallangBuilder\Domain\Model\{Extension, Locallang, Translation};
use Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits\{ExtensionRepositoryTrait, LocallangRepositoryTrait};
use Datamints\DatamintsLocallangBuilder\Service\Traits\XmlServiceTrait;
use Datamints\DatamintsLocallangBuilder\Utility\LanguageUtility;
use DOMDocument;
use DOMElement;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;

class ManifestBuildService extends AbstractService
{
    use ExtensionRepositoryTrait;
    use LocallangRepositoryTrait;

    public const PERSIST = true;
    /**
     * Constant for relative path from extension-root to the language files to be scanned
     */
    public const EXTENSION_LANGUAGE_PATH = "Resources/Private/Language/";

    public function __construct(
        protected readonly CustomTranslationsOverlayService $customTranslationsOverlayService,
        protected readonly XmlService $xmlService,
    )
    {}

    /**
     * Gets a Extension entity from db otherwise creates one new
     */
    public function getExtensionPart(?array $extensionDTO): ?Extension
    {
        if (is_null($extensionDTO) || !is_array($extensionDTO) || strlen(
                $extensionDTO['key']
            ) === 0) { // We dont throw an exception when there are invalid extensions
            return null;
        }

        // Check, if theres already one persisted entity. If so, return it. Otherwise create one, persist it (to get the uid) and return it
        /** @var Extension $extensionEntity */
        $extensionEntity = $this->extensionRepository->findOneByName($extensionDTO['key'] ?? 'invalidname');
        if ($extensionEntity) {
            return $extensionEntity;
        }
        return $this->createExtension($extensionDTO);
    }

    /**
     * Creates a new Extension and persists the entity. Also scans initially for locallang-files and creates references
     */
    protected function createExtension(array $object): Extension
    {
        /** @var Extension $extension */
        $extension = GeneralUtility::makeInstance(Extension::class);
        $extension->setName($object['key'] ?? 'unknown');
        $extension->setPath($object['path'] ?? 'unknown');
        $extension->setLocal($object['local'] ?? false);

//        if($extension->isLocal()) { // we dont need locallang-files for non-local extensions, because those should be translated via translation manager
        $this->getDefaultLocallangPart($extension);
//        }

        if (self::PERSIST) {
            $this->extensionRepository->add(
                $extension
            ); // Subobjects are added recursively, so its the only needed directive to add something
        }
        return $extension;
    }

    /**
     * Creates locallang-entities for default-languages related to an extension. It wont check, if the entity is already existing, because extension entities are unique, so it shouldnt be possible for duplicates
     */
    protected function getDefaultLocallangPart(Extension $extension): void
    {
        // First step is to create default-language related locallangs. We have to loop two times, to connect the custom language related stuff to the default language
        foreach ($this->findRelatedLocallangFiles($extension->getPath()) as $locallangFilePath) {
            if (LanguageUtility::isDefaultLanguageFile(pathinfo($locallangFilePath)['filename'])) {
                /** @var Locallang $locallang */
                $locallang = GeneralUtility::makeInstance(Locallang::class);
                $locallang->setFilename($locallangFilePath);
                $locallang->setPath($extension->getPath() . self::EXTENSION_LANGUAGE_PATH . $locallangFilePath);
                $locallang->setImported(false);
                $locallang->setRelatedExtension($extension);
                $extension->addLocallang($locallang);
            }
        }
    }

    public function importLocallang(Locallang $locallang): Locallang
    {
        $locallang->setInvalidFormat(false);
        $this->getTranslationPart($locallang, $locallang->getPath(), true);

        if (!$locallang->getInvalidFormat()) {
            $this->importCustomTranslationsForLocallang($locallang);
        }

        $locallang->setImported($locallang->hasTranslations());

        return $locallang;
    }

    public function createEmptyLocallang(Extension $extension, string $filename): Locallang
    {
        $normalizedFilename = $this->normalizeNewLocallangFilename($filename);
        $relativePath = $extension->getPath() . self::EXTENSION_LANGUAGE_PATH . $normalizedFilename;
        $absolutePath = GeneralUtility::getFileAbsFileName($relativePath);

        if ($absolutePath === '' || PathUtility::isAbsolutePath($relativePath)) {
            throw new \RuntimeException('Could not resolve the target path for the new file.');
        }

        if ($this->locallangExists($extension, $normalizedFilename) || file_exists($absolutePath)) {
            throw new \RuntimeException(sprintf('The file "%s" already exists.', $normalizedFilename));
        }

        GeneralUtility::mkdir_deep(dirname($absolutePath));
        $this->writeEmptyLocallangFile($absolutePath, $extension->getName(), $normalizedFilename);

        /** @var Locallang $locallang */
        $locallang = GeneralUtility::makeInstance(Locallang::class);
        $locallang->setFilename($normalizedFilename);
        $locallang->setPath($relativePath);
        $locallang->setImported(true);
        $locallang->setInvalidFormat(false);
        $locallang->setRelatedExtension($extension);

        $extension->addLocallang($locallang);
        $this->extensionRepository->save($extension);

        return $locallang;
    }

    /**
     * Finds related locallang files in the "Language"-Folder that belong to an extension
     */
    protected function findRelatedLocallangFiles(string $extensionPath): array
    {
        if (!PathUtility::isAbsolutePath($extensionPath)) {
            $languageFullPath = $extensionPath . self::EXTENSION_LANGUAGE_PATH;
            return GeneralUtility::getFilesInDir(GeneralUtility::getFileAbsFileName(ltrim($languageFullPath, "./")));
        } else {
            return [];
        }
    }

    protected function getTranslationPart(Locallang $locallang, string $path, bool $isDefaultLanguage = false): void
    {
        $path = GeneralUtility::getFileAbsFileName($this->customTranslationsOverlayService->setOverlay($path));
        /** @var DOMElement $fileDOM */
        $fileDOM = $this->xmlService->getXMLContentByLocallang($path, 'file');
        if (is_null($fileDOM) || !method_exists(
                $fileDOM,
                'getAttribute'
            )) { // if we couldnt receive xml-content, the file could possibly be invalid or broken. In this case we skip this locallang
            $locallang->setInvalidFormat(true);
            return;
        }
        try {
            $sourceLanguage = $fileDOM->getAttribute('source-language');

            //            if($fileDOM->hasAttribute('target-language')) {
            //                $targetLanguage = $fileDOM->getAttribute('target-language');
            //            } else if(!$isDefaultLanguage) {

            // You cannot rely on the correct target language being stored as an attribute in the file, so we prefer to trust the file name prefix, e.g. nl.locallang.xlf
            if (!$isDefaultLanguage) {
                // Fallback when the file does not contain a target-language attribute. Instead we fetch the language code from the filename of the path (NOT from the locallang-file, because its already the generic one without language-prefix!)
                $targetLanguage = LanguageUtility::getLanguageByFilename(pathinfo($path)['filename']);
            }
            //            }
        } catch (Exception $e) {
            $locallang->setInvalidFormat(true);
            return;
        }
        $xmlContent = $this->xmlService->getXMLContentByLocallang($path, 'trans-unit');

        if (is_null(
            $xmlContent
        )) { // if we couldnt receive xml-content, the file could possibly be invalid or broken. In this case we skip this locallang
            $locallang->setInvalidFormat(true);
            return;
        }

        if (is_a($xmlContent, DOMElement::class)) {
            $xmlContent = [$xmlContent];
        }
        /** @var DOMElement $domElement */
        foreach ($xmlContent as $domElement) {
            $isNew = true;
            // We take a look, if there already the same key registered
            foreach ($locallang->getTranslations() as $translation) {
                if ($translation->getTranslationKey() === $domElement->getAttribute('id')) {
                    $isNew = false;
                    break;
                }
            }
            if ($isNew) {
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

    protected function importCustomTranslationsForLocallang(Locallang $locallang): void
    {
        $extension = $locallang->getRelatedExtension();

        foreach ($this->findRelatedLocallangFiles($extension->getPath()) as $locallangFilePath) {
            $pathinfo = pathinfo($locallangFilePath);
            if (!LanguageUtility::isDefaultLanguageFile($pathinfo['filename'])) {
                if (
                    $locallang->getPath() === LanguageUtility::getDefaultLanguagePath(
                        $extension->getPath() . self::EXTENSION_LANGUAGE_PATH . $locallangFilePath
                    )
                ) {
                    $this->getTranslationPart(
                        $locallang,
                        $extension->getPath() . self::EXTENSION_LANGUAGE_PATH . $locallangFilePath
                    );
                }
            }
        }
    }

    protected function normalizeNewLocallangFilename(string $filename): string
    {
        $normalizedFilename = trim($filename);
        if ($normalizedFilename === '') {
            throw new \InvalidArgumentException('Please provide a file name.');
        }
        if (str_contains($normalizedFilename, '/') || str_contains($normalizedFilename, '\\')) {
            throw new \InvalidArgumentException('Please provide only a file name without subdirectories.');
        }
        if (!preg_match('/^[A-Za-z0-9_-]+(?:\.[A-Za-z0-9_-]+)?$/', $normalizedFilename)) {
            throw new \InvalidArgumentException('Use only letters, numbers, underscores, and hyphens.');
        }
        if (!str_ends_with(strtolower($normalizedFilename), '.xlf')) {
            $normalizedFilename .= '.xlf';
        }

        $filenameWithoutExtension = pathinfo($normalizedFilename, PATHINFO_FILENAME);
        if (!LanguageUtility::isDefaultLanguageFile($filenameWithoutExtension)) {
            throw new \InvalidArgumentException('Please create the default-language file, for example "locallang_custom.xlf".');
        }

        return $normalizedFilename;
    }

    protected function locallangExists(Extension $extension, string $filename): bool
    {
        foreach ($extension->getLocallangs() as $locallang) {
            if (strcasecmp($locallang->getFilename(), $filename) === 0) {
                return true;
            }
        }

        return false;
    }

    protected function writeEmptyLocallangFile(string $absolutePath, string $extensionName, string $filename): void
    {
        $fileNameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);

        $document = new DOMDocument('1.0', 'utf-8');
        $document->formatOutput = true;

        $xliff = $document->createElement('xliff');
        $xliff->setAttribute('version', '1.0');
        $document->appendChild($xliff);

        $file = $document->createElement('file');
        $file->setAttribute('original', $extensionName . '/Resources/Private/Language/' . $fileNameWithoutExtension);
        $file->setAttribute('source-language', 'en');
        $file->setAttribute('datatype', 'plaintext');
        $file->setAttribute('date', date(DATE_ATOM));
        $file->setAttribute('product-name', $extensionName);
        $xliff->appendChild($file);

        $file->appendChild($document->createElement('header'));
        $file->appendChild($document->createElement('body'));

        if ($document->save($absolutePath) === false) {
            throw new \RuntimeException(sprintf('Could not write the file "%s".', $filename));
        }
    }
}
