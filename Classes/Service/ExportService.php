<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Service;

use Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Runtime\LocallangExport;
use Datamints\DatamintsLocallangBuilder\Exporter\AbstractExporter;
use Datamints\DatamintsLocallangBuilder\Exporter\JsonExporter;
use Datamints\DatamintsLocallangBuilder\Exporter\XmlExporter;
use Datamints\DatamintsLocallangBuilder\Exporter\YamlExporter;
use Datamints\DatamintsLocallangBuilder\Utility\LanguageUtility;
use TYPO3\CMS\Core\Exception;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ExportService extends AbstractService
{
    public function __construct(
        protected readonly LocallangService $locallangService,
        protected readonly XmlService $xmlService,
        protected readonly CustomTranslationsOverlayService $customTranslationsOverlayService
    )
    {}

    /**
     * Constant to fileadmin save-storage
     */
    public const FILEADMIN_PATH = 'fileadmin/locallang-builder/';
    public const FILETYPE_XML_XLF = 'xml-xlf';
    public const FILETYPE_JSON = 'json';
    public const FILETYPE_YAML = 'yaml';
    public const XLIFF_VERSION_12 = '1.2';
    public const XLIFF_VERSION_20 = '2.0';

    /**
     * Export
     *
     * @throws Exception
     */
    public function export(Locallang $locallang, array $exportConfiguration): array
    {
        $fileExtension = $this->resolveFileExtension($exportConfiguration);
        $countries = $this->locallangService->getCountryList(
            $locallang
        ); // Getting country list, so we know, which files have to be generated
        $outputLocallangs = [];
        foreach ($countries as $country) {
            /** @var LocallangExport $locallangExport */
            $locallangExport = GeneralUtility::makeInstance(LocallangExport::class);
            $locallangExport->setLanguageCode($country);
            $locallangExport->setLocallangReference($locallang);
            $locallangExport->setXliffVersion($this->resolveXliffVersion($exportConfiguration));

            $targetPath = '';

            // When we want to save the files to fileadmin instead
            if ($exportConfiguration['selectedTarget'] === 'fileadmin') {
                $targetPath = $this->getFileadminOutputPath($locallang);
            } else { // Otherwise we overwrite the existing files
                $targetPath = $locallang->getPath();
            }
            $targetPath = $this->replaceFileExtension(
                $this->customTranslationsOverlayService->setOverlay($targetPath),
                $fileExtension
            );
            if ($locallangExport->getLanguageCode() != 'en') { // we dont need the lang-code for default-language
                $targetPath = LanguageUtility::getCountryLanguagePath($country, $targetPath);
            }
            $locallangExport->setTargetPath($this->customTranslationsOverlayService->setOverlay($targetPath));
            $outputLocallangs[$country] = $locallangExport;
        }

        $exporter = $this->resolveExporter($exportConfiguration);
        $savedFiles = [];
        foreach ($outputLocallangs as $locallangExportEntity) {
            $savedFiles[] = $exporter->writeByLocallangExport($locallangExportEntity);
        }
        return $savedFiles;
    }


    /**
     * Delivers the alternative fileadmin output path
     *
     * @param Locallang $locallang
     * @return string
     * @throws Exception
     */
    protected function getFileadminOutputPath(Locallang $locallang): string
    {
        $readableDateTime = new \DateTime();
        $customPath = $this->configurationService->getExtensionConfiguration()['exportPath'];
        $exportPathDate = boolval($this->configurationService->getExtensionConfiguration()['exportPathDate']);
        if (!is_dir(
            GeneralUtility::getFileAbsFileName($customPath)
        )) { // Checking if export-folder exists. It may be that the admin changed the extension-settings recently, so a permanent check is required
            \mkdir(GeneralUtility::getFileAbsFileName($customPath));
        }

        if (GeneralUtility::validPathStr(
            $customPath
        )) { // Check if the path is valid and does not contain illegal chars
            return $customPath . $locallang->getRelatedExtension()->getName(
                ) . (($exportPathDate) ? '/' . $readableDateTime->format(
                        'Y-m-d___H-i-s'
                    ) . '/' : '/') . ManifestBuildService::EXTENSION_LANGUAGE_PATH . $locallang->getFilename();
        } else {
            throw new Exception(
                'The path defined in the extensionsettings for exportPath is not valid. It may contain illegal characters, is not in the project-scope or does not exist. Please check: ' . $customPath
            );
        }
        return '';
    }

    protected function resolveExporter(array $exportConfiguration): AbstractExporter
    {
        return match ($exportConfiguration['selectedFiletype'] ?? self::FILETYPE_XML_XLF) {
            self::FILETYPE_JSON => GeneralUtility::makeInstance(JsonExporter::class),
            self::FILETYPE_YAML => GeneralUtility::makeInstance(YamlExporter::class),
            default => GeneralUtility::makeInstance(XmlExporter::class),
        };
    }

    protected function resolveFileExtension(array $exportConfiguration): string
    {
        return match ($exportConfiguration['selectedFiletype'] ?? self::FILETYPE_XML_XLF) {
            self::FILETYPE_JSON => 'json',
            self::FILETYPE_YAML => 'yaml',
            default => 'xlf',
        };
    }

    protected function replaceFileExtension(string $path, string $fileExtension): string
    {
        $pathInfo = \pathinfo($path);
        $dirname = $pathInfo['dirname'] ?? '';
        $filename = $pathInfo['filename'] ?? $path;

        if ($dirname === '' || $dirname === '.') {
            return $filename . '.' . $fileExtension;
        }

        return $dirname . '/' . $filename . '.' . $fileExtension;
    }

    protected function resolveXliffVersion(array $exportConfiguration): string
    {
        $selectedVersion = (string)($exportConfiguration['selectedXliffVersion'] ?? self::XLIFF_VERSION_12);

        return \in_array($selectedVersion, [self::XLIFF_VERSION_12, self::XLIFF_VERSION_20], true)
            ? $selectedVersion
            : self::XLIFF_VERSION_12;
    }
}
