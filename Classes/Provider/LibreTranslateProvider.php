<?php


namespace Datamints\DatamintsLocallangBuilder\Provider;

/* * *************************************************************
 * This file is part of the "locallang builder" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2024 Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 * ************************************************************* */

use Exception;

class LibreTranslateProvider extends AbstractProvider
{
	/**
	 * @see \TYPO3\CMS\Extbase\Mvc\View\JsonView::setVariablesToRender()
	 */
	public function getName(): string
	{
		return "Azure";
    }

	protected function getApiPath(): string
	{
		return $this->getSettings()['providers']['libretranslate']['url'];
	}

	protected function getUrlArguments(): string
	{
		return '?api-version=' . $this->getVersion() . '&from=en&to=' . $this->payload['to'];
	}

	protected function getVersion(): string
	{
		return $this->getSettings()['providers']['libretranslate']['version'];
	}

	protected function getKey(): string
	{
		return $this->getExtensionConfig()['libretranslateApiKey'];
	}

	protected function extractResponse($response): string
	{
		try {
			$response = json_decode($response, true);
			// DebuggerUtility::var_dump($response);
			// die();
			// i dont know why, but we have to loop through the response from azure
			foreach ($response as $responseEntry) {
				if($responseEntry['translations']) {
					// and again to get the value. Maybe its possible to translate multiple strings at once, but we dont need this
					foreach ($responseEntry['translations'] as $responseTranslation) {
						if($responseTranslation['text']) {
							return $responseTranslation['text']; // we got our requested value
						}
					}
				}
			}
			return 'No text found';
		} catch (Exception $e) {
			// TODO - pass response from api
			return 'Error';
		}
	}

	protected function getContent(): string
	{
		return json_encode([
			[
				'Text' => $this->text,
			],
		]);
	}
}
