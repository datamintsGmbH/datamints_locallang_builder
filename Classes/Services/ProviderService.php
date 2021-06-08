<?php

/**
 * Copyright (c) 2021. Mark Weisgerber (mark.weisgerber@outlook.de / m.weisgerber@datamints.com)
 */

namespace Datamints\DatamintsLocallangBuilder\Services;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang;

class ProviderService extends AbstractService
{

	/**
	 * Gets the translation service provider that is configured in typoscript
	 *
	 * @return string
	 */
	public function getConfiguredProvider(): string
	{
		$settingsRef = $this->getSettings();
		// Checking if azure is configured
		if($settingsRef['providers'] && $settingsRef['providers']['azure']) {
			if(\intval($settingsRef['providers']['azure']['active']) == 1 && $settingsRef['providers']['azure']['key']) {
				return 'AzureCloud';
			} elseif(\intval($settingsRef['providers']['google']['active']) == 1 && $settingsRef['providers']['google']['key']) {
				return 'GoogleTranslate';
			} elseif(\intval($settingsRef['providers']['deepl']['active']) == 1 && $settingsRef['providers']['deepl']['key']) {
				return 'DeepL';
			}
		}

        return '';
	}
}
