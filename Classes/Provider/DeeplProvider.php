<?php


namespace Datamints\DatamintsLocallangBuilder\Provider;

/* * *************************************************************
 * This file is part of the "locallang builder" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 * ************************************************************* */

use Exception;
use TYPO3\CMS\Extbase\{DomainObject\DomainObjectInterface, Persistence\RepositoryInterface};
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class DeeplProvider extends AbstractProvider
{


	/**
	 * @see \TYPO3\CMS\Extbase\Mvc\View\JsonView::setVariablesToRender()
	 */
	public function getName(): string
	{
		return "deepl";
	}

	protected function getApiPath(): string
	{
		return $this->getSettings()['providers']['deepl']['url'];
	}

	/**
	 * Not required for deepl
	 *
	 * @return string
	 */
	protected function getUrlArguments(): string
	{
		return '';
	}

	/**
	 * Not required for deepl
	 *
	 * @return string
	 */
	protected function getVersion(): string
	{
		return "";
	}

	protected function getKey(): string
	{
		return $this->getSettings()['providers']['deepl']['key'];
	}

	protected function extractResponse($response): string
	{
		try {
			$response = json_decode($response, true);
			// DebuggerUtility::var_dump($response);
			// die();
			if($response['translations']) {
				// and again to get the value. Maybe its possible to translate multiple strings at once, but we dont need this
				foreach ($response['translations'] as $responseTranslation) {
					if($responseTranslation['text']) {
						return $responseTranslation['text']; // we got our requested value
					}
				}
			}
			return 'No text found';
		} catch (Exception $e) {
			// TODO - pass response from api
			return 'Error';
		}
	}

	/**
	 * Not required for deepl
	 *
	 * @return string
	 */
	protected function getContent(): string
	{
		return '';
	}

	/**
	 * Streams data to api
	 *
	 * @param string $url
	 * @param string $key
	 * @param string $params
	 * @param string $content
	 *
	 * @return false|string
	 */
	protected function stream(string $url, $key, $params, $content): string
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "auth_key=" . $key . "&text=" . $this->text . "&source_lang=EN&target_lang=" . \strtoupper($this->payload['to']));

		$headers = [];
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		if(curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpCode != 200) {
			throw new \TYPO3\CMS\Core\Exception("The API fetched an error-code", $httpCode);
		}

		curl_close($ch);

		return $result;
    }
}
