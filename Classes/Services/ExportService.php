<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Services;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use Datamints\DatamintsLocallangBuilder\Exporter\XmlExporter;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang;
use Datamints\DatamintsLocallangBuilder\Utility\LanguageUtility;
use Datamints\DatamintsLocallangBuilder\Services\Traits\XmlServiceTrait;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Runtime\LocallangExport;
use Datamints\DatamintsLocallangBuilder\Services\Traits\LocallangServiceTrait;

class ExportService extends AbstractService
{
    use LocallangServiceTrait;
    use XmlServiceTrait;
    use \Datamints\DatamintsLocallangBuilder\Services\Traits\ConfigurationServiceTrait;

    /**
     * Constant to fileadmin save-storage
     */
    public const FILEADMIN_PATH = 'fileadmin/locallang-builder/';

    /**
     * Export
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang
     * @param array                                                       $exportConfiguration
     *
     * @return array
     */
    public function export(Locallang $locallang, array $exportConfiguration): array
    {
        $countries = $this->locallangService->getCountryList($locallang); // Getting country list, so we know, which files have to be generated
        $outputLocallangs = [];
        foreach ($countries as $country) {
            /** @var LocallangExport $locallangExport */
            $locallangExport = GeneralUtility::makeInstance(LocallangExport::class);
            $locallangExport->setLanguageCode($country);
            $locallangExport->setLocallangReference($locallang);

            $targetPath = '';

            // When we want to save the files to fileadmin instead
            if($exportConfiguration['selectedTarget'] === 'fileadmin') {
                $targetPath = $this->getFileadminOutputPath($locallang);
            } else { // Otherwise we overwrite the existing files
                $targetPath = $locallang->getPath();
            }
            if($locallangExport->getLanguageCode() != 'en') { // we dont need the lang-code for default-language
                $targetPath = LanguageUtility::getCountryLanguagePath($country, $targetPath);
            }
            $locallangExport->setTargetPath($targetPath);
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
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang
     *
     * @return string
     */
    protected function getFileadminOutputPath(Locallang $locallang): string
    {
        $readableDateTime = new \DateTime();
        $customPath = $this->configurationService->getExtensionConfiguration()['exportPath'];
        if(!is_file(GeneralUtility::getFileAbsFileName($customPath))) { // Checking if export-folder exists. It may be that the admin changed the extension-settings recently, so a permanent check is required
            \mkdir(GeneralUtility::getFileAbsFileName($customPath));
        }

        if(GeneralUtility::validPathStr($customPath)) { // Check if the path is valid and does not contain illegal chars
            return $customPath . $locallang->getRelatedExtension()->getName() . '/' . $readableDateTime->format('Y-m-d___H-i-s') . '/' . ManifestBuildService::EXTENSION_LANGUAGE_PATH . $locallang->getFilename();
        } else {
            throw new \TYPO3\CMS\Core\Exception('The path defined in the extensionsettings for exportPath is not valid. It may contain illegal characters, is not in the project-scope or does not exist. Please check: ' . $customPath);
        }
        return '';
    }
}
