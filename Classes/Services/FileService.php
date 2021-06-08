<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Services;

use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\PathUtility;

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
				'path' => PathUtility::sanitizeTrailingSeparator('typo3conf/ext/' . $extensionKey),
			];
		}
		return $extensionsObject;
    }
}
