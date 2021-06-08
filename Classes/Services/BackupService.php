<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Services;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang;

class BackupService extends AbstractService
{
	/**
	 * Constant to fileadmin backup-storage
	 */
	public const BACKUPS_PATH = 'fileadmin/locallang-builder/backups/';

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
		$absoluteFolderPathTo = GeneralUtility::getFileAbsFileName(self::BACKUPS_PATH . $extensionContext . '/' . $readableDateTime->format('Y-m-d___H-i-s') . '/' . ManifestBuildService::EXTENSION_LANGUAGE_PATH);
		GeneralUtility::copyDirectory($absoluteFolderPathFrom, $absoluteFolderPathTo);
        return true;

	}
}
