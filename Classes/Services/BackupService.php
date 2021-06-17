<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Services;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang;

class BackupService extends AbstractService
{
    use \Datamints\DatamintsLocallangBuilder\Services\Traits\ConfigurationServiceTrait;

    /**
     * Makes backup of a locallang and its whole related directory
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang
     *
     * @return bool
     */
    public function backupLocallang(Locallang $locallang): bool
    {
        if(!$locallang) {
            return false;
        } else {
            return $this->triggerDirectoryBackup(// Just pass the directory path
                str_replace($locallang->getFilename(), '', $locallang->getPath()),
                $locallang->getRelatedExtension()->getName()
            );
        }
    }

    /**
     * Creates backup of a specified directory path
     *
     * @param string $folderPath
     * @param string $extensionContext
     *
     * @return bool
     */
    protected function triggerDirectoryBackup(string $folderPath, string $extensionContext)
    {

        $readableDateTime = new \DateTime();
        $absoluteFolderPathFrom = GeneralUtility::getFileAbsFileName(ltrim($folderPath, "./")); // Getting absolute path because copyDirectory-Function requires an absolute path
        $customPath = $this->configurationService->getExtensionConfiguration()['backupPath'];
        $absoluteFolderPathTo = GeneralUtility::getFileAbsFileName($customPath . $extensionContext . '/' . $readableDateTime->format('Y-m-d___H-i-s') . '/' . ManifestBuildService::EXTENSION_LANGUAGE_PATH);

        if(!is_file(GeneralUtility::getFileAbsFileName($customPath))) { // Checking if export-folder exists. It may be that the admin changed the extension-settings recently, so a permanent check is required
            \mkdir(GeneralUtility::getFileAbsFileName($customPath));
        }

        if(GeneralUtility::validPathStr($customPath)) { // Check if the path is valid and does not contain illegal chars
            GeneralUtility::copyDirectory($absoluteFolderPathFrom, $absoluteFolderPathTo);
            return true;

        } else {
            throw new \TYPO3\CMS\Core\Exception('The path defined in the extensionsettings for backupPath is not valid. It may contain illegal characters, is not in the project-scope or does not exist.');
            return false;

        }
    }
}
