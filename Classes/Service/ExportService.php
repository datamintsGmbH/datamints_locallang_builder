<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Service;

use Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Runtime\LocallangExport;
use Datamints\DatamintsLocallangBuilder\Exporter\XmlExporter;
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
    public const string FILEADMIN_PATH = 'fileadmin/locallang-builder/';

    /**
     * Export
     *
     * @throws Exception
     */
    public function export(Locallang $locallang, array $exportConfiguration): array
    {
        $countries = $this->locallangService->getCountryList(
            $locallang
        ); // Getting country list, so we know, which files have to be generated
        $outputLocallangs = [];
        foreach ($countries as $country) {
            /** @var LocallangExport $locallangExport */
            $locallangExport = GeneralUtility::makeInstance(LocallangExport::class);
            $locallangExport->setLanguageCode($country);
            $locallangExport->setLocallangReference($locallang);

            $targetPath = '';

            // When we want to save the files to fileadmin instead
            if ($exportConfiguration['selectedTarget'] === 'fileadmin') {
                $targetPath = $this->getFileadminOutputPath($locallang);
            } else { // Otherwise we overwrite the existing files
                $targetPath = $locallang->getPath();
            }
            if ($locallangExport->getLanguageCode() != 'en') { // we dont need the lang-code for default-language
                $targetPath = LanguageUtility::getCountryLanguagePath($country, $this->customTranslationsOverlayService->setOverlay($targetPath));
            }
            $locallangExport->setTargetPath($this->customTranslationsOverlayService->setOverlay($targetPath));
            $outputLocallangs[$country] = $locallangExport;
        }

        // currently only one exporter is possible. I think its currently not necessary to add functionality to be able to select one from configuration to swap to json or something else.
        // In typo3 its only possible to choose xml.
        // maybe in the future?!

        /** @var XmlExporter $exporter */
        $exporter = GeneralUtility::makeInstance(XmlExporter::class);
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
}
