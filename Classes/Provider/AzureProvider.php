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

class AzureProvider extends AbstractProvider
{


	/**
	 * @see \TYPO3\CMS\Extbase\Mvc\View\JsonView::setVariablesToRender()
	 */
	public function getName(): string
	{
		return "Azure";
    }

	public function getStatus(): array
	{
		$quotaMessage = 'Azure does not expose remaining quota through the Translator API. Please use Azure Metrics or the Azure portal.';
		$headers = [
			'Content-Type: application/json',
			'Ocp-Apim-Subscription-Key: ' . $this->getKey(),
			'X-ClientTraceId: ' . \Datamints\DatamintsLocallangBuilder\Utility\CurlUtility::createGuid(),
		];

		$region = \trim((string)($this->getSettings()['providers']['azure']['area'] ?? ''));
		if ($region !== '' && \strtolower($region) !== 'global') {
			$headers[] = 'Ocp-Apim-Subscription-Region: ' . $region;
		}

		$response = $this->executeCurlRequest(
			$this->getApiPath() . '?api-version=' . $this->getVersion() . '&from=en&to=de',
			[
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => \json_encode([['Text' => 'Status']]),
				CURLOPT_HTTPHEADER => $headers,
			]
		);

		if ($response['error'] !== null) {
			return $this->buildStatusResponse(
				null,
				'The Azure status request failed: ' . $response['error'],
				false,
				null,
				null,
				null,
				null,
				$quotaMessage
			);
		}

		if ($response['statusCode'] === 200) {
			$meteredUsage = $response['headers']['x-metered-usage'] ?? '';
			if ($meteredUsage !== '') {
				$quotaMessage = 'Azure returned metered usage for this probe request: ' . $meteredUsage . '. Remaining quota is still only available via Azure Metrics.';
			}

			return $this->buildStatusResponse(
				true,
				'The Azure API key is valid.',
				false,
				null,
				null,
				null,
				null,
				$quotaMessage
			);
		}

		$errorMessage = $this->extractApiErrorMessage(
			$response['body'],
			'The Azure API key could not be validated.'
		);

		if (\in_array($response['statusCode'], [401, 403], true)) {
			return $this->buildStatusResponse(false, $errorMessage, false, null, null, null, null, $quotaMessage);
		}

		return $this->buildStatusResponse(null, $errorMessage, false, null, null, null, null, $quotaMessage);
	}

	protected function getApiPath(): string
	{
		return $this->getSettings()['providers']['azure']['url'];
	}

	protected function getUrlArguments(): string
	{
		return '?api-version=' . $this->getVersion() . '&from=en&to=' . $this->payload['to'];
	}

	protected function getVersion(): string
	{
		return $this->getSettings()['providers']['azure']['version'];
	}

	protected function getKey(): string
	{
		return $this->getExtensionConfig()['azureApiKey'];
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
