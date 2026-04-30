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
		return "DeepL";
	}

	public function getStatus(): array
	{
		$supportedTargetLanguages = $this->getSupportedTargetLanguages();
		$response = $this->executeCurlRequest(
			\preg_replace('#/translate/?$#', '/usage', $this->getApiPath()),
			[
				CURLOPT_HTTPHEADER => [
					'Authorization: DeepL-Auth-Key ' . $this->getKey(),
					'Accept: application/json',
				],
			]
		);

		if ($response['error'] !== null) {
			return $this->buildStatusResponse(
				null,
				'The DeepL status request failed: ' . $response['error'],
				false,
				null,
				null,
				null,
				null,
				'',
				$supportedTargetLanguages
			);
		}

		$decodedResponse = \json_decode($response['body'], true);
		if ($response['statusCode'] === 200 && \is_array($decodedResponse)) {
			$used = (int)($decodedResponse['character_count'] ?? 0);
			$limit = (int)($decodedResponse['character_limit'] ?? 0);

			return $this->buildStatusResponse(
				true,
				'The DeepL API key is valid.',
				true,
				\max($limit - $used, 0),
				$used,
				$limit,
				'characters',
				'DeepL reports the remaining characters for the current billing period.',
				$supportedTargetLanguages
			);
		}

		$errorMessage = $this->extractApiErrorMessage(
			$response['body'],
			'The DeepL API key could not be validated.'
		);

		if (\in_array($response['statusCode'], [401, 403], true)) {
			return $this->buildStatusResponse(false, $errorMessage, false, null, null, null, null, '', $supportedTargetLanguages);
		}

		return $this->buildStatusResponse(null, $errorMessage, false, null, null, null, null, '', $supportedTargetLanguages);
	}

	public function getSupportedTargetLanguages(): array
	{
		$response = $this->executeCurlRequest(
			\preg_replace('#/translate/?$#', '/languages?type=target', $this->getApiPath()),
			[
				CURLOPT_HTTPHEADER => [
					'Authorization: DeepL-Auth-Key ' . $this->getKey(),
					'Accept: application/json',
				],
			]
		);

		if ($response['statusCode'] !== 200 || $response['error'] !== null) {
			return [];
		}

		$decodedResponse = \json_decode($response['body'], true);
		if (!\is_array($decodedResponse)) {
			return [];
		}

		return $this->normalizeSupportedTargetLanguages(\array_column($decodedResponse, 'language'));
	}

	protected function mapSupportedTargetLanguageCode(string $languageCode): array
	{
		$normalizedLanguageCode = $this->normalizeLanguageCode($languageCode);

		if ($normalizedLanguageCode === 'pt-br') {
			return ['pt', 'pt-br'];
		}

		return parent::mapSupportedTargetLanguageCode($normalizedLanguageCode);
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
        return $this->getExtensionConfig()['deepLApiKey'];
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
		$postFields = \http_build_query(
			[
				'text' => $this->text,
				'formality' => $this->getExtensionConfig()['formality'],
				'source_lang' => 'EN',
				'target_lang' => \strtoupper($this->payload['to']),
			]
		);

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		$headers = [];
		$headers[] = 'Authorization: DeepL-Auth-Key ' . $key;
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		if(curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($httpCode != 200) {
			throw new \TYPO3\CMS\Core\Exception("The API fetched an error-code: " . $httpCode);
		}

		curl_close($ch);

		return $result;
    }
}
