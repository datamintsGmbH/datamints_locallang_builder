<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Service;

use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class FileService extends AbstractService
{

	/**
	 * Gets all loaded extensions
	 *
	 * @return array
	 */
	public function getExtensionsList(): array
	{
		$extensionsList = ExtensionManagementUtility::getLoadedExtensionListArray();

		sort($extensionsList);
		$extensionsObject = [];
		foreach ($extensionsList as $extensionKey) {
			$extensionsObject[] = [
				'key' => $extensionKey,
				'local' => strpos(ExtensionManagementUtility::extPath($extensionKey), Environment::getExtensionsPath()) > -1,
				'path' => PathUtility::sanitizeTrailingSeparator('EXT:' . $extensionKey),
			];
		}
		return $extensionsObject;
    }
}
