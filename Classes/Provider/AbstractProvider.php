<?php


namespace Datamints\DatamintsLocallangBuilder\Provider;

/* * *************************************************************
 * This file is part of the "locallang builder" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 * ************************************************************* */

use TYPO3\CMS\Extbase\{DomainObject\DomainObjectInterface, Persistence\RepositoryInterface};
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use Datamints\DatamintsLocallangBuilder\Service\AbstractService;
use Datamints\DatamintsLocallangBuilder\Utility\CurlUtility;
use Datamints\DatamintsLocallangBuilder\Utility\LogUtility;

abstract class AbstractProvider extends AbstractService
{
    /**
     * @var mixed
     */
    protected $payload;

    /**
     * @var string
     */
    protected $text;

    /**
     *
     * @param string $text
     * @param mixed  $payload misc stuff, sometimes api related, so we dont transfer 100 function arguments with different types
     */
    public function getTranslation(string $text, $payload): string
    {
        $this->payload = $payload;
        $this->text = $text;

        $response = $this->stream($this->getApiPath(), $this->getKey(), $this->getUrlArguments(), $this->getContent());

        return $this->extractResponse($response);
    }

    public function hasApiKey(): bool
    {
        return \trim((string)$this->getKey()) !== '';
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

        $headers = "Content-type: application/json\r\n" .
            "Content-length: " . strlen($content) . "\r\n" .
            "Ocp-Apim-Subscription-Key: $key\r\n" .
            "X-ClientTraceId: " . CurlUtility::createGuid() . "\r\n";

        // NOTE: Use the key 'http' even if you are making an HTTPS request. See:
        // http://php.net/manual/en/function.stream-context-create.php
        $options = [
            'http' => [
                'header' => $headers,
                'method' => 'POST',
                'content' => $content,
            ],
        ];
        $this->logger->info('API CALL for URL ' . $url . $params . ' ||| Content: ' . $content);
        $context = stream_context_create($options);
        $result = file_get_contents($url . $params, false, $context);
        return $result;
    }

    /**
     * Path for api call. Should be defined in TS <settings.providername.url>
     */
    abstract protected function getApiPath(): string;

    /**
     * api key
     */
    abstract protected function getKey(): string;

    protected function getUrlArguments(): string
    {
        return '';
    }

    /**
     * Content to submit
     */
    abstract protected function getContent(): string;

    /**
     * Extracts the response, so the controller knows the translation value
     *
     * @param mixed $response
     */
    abstract protected function extractResponse($response): string;

    /**
     * Name of the provider
     */
    abstract public function getName(): string;

    /**
     * Returns provider availability and quota details for the dashboard.
     */
    abstract public function getStatus(): array;

    public function getSupportedTargetLanguages(): array
    {
        return [];
    }

    /**
     * Not required by any provider
     */
    protected function getVersion(): string
    {
        return "1.0";
    }

    protected function buildStatusResponse(
        ?bool $valid,
        string $message,
        bool $quotaAvailable = false,
        ?int $quotaRemaining = null,
        ?int $quotaUsed = null,
        ?int $quotaLimit = null,
        ?string $quotaUnit = null,
        string $quotaMessage = '',
        array $supportedTargetLanguages = []
    ): array {
        return [
            'provider' => $this->getName(),
            'configured' => true,
            'keyConfigured' => $this->hasApiKey(),
            'valid' => $valid,
            'message' => $message,
            'quotaAvailable' => $quotaAvailable,
            'quotaRemaining' => $quotaRemaining,
            'quotaUsed' => $quotaUsed,
            'quotaLimit' => $quotaLimit,
            'quotaUnit' => $quotaUnit,
            'quotaMessage' => $quotaMessage,
            'supportedTargetLanguages' => $supportedTargetLanguages,
        ];
    }

    protected function normalizeLanguageCode(string $languageCode): string
    {
        return \strtolower(\str_replace('_', '-', \trim($languageCode)));
    }

    protected function mapSupportedTargetLanguageCode(string $languageCode): array
    {
        $normalizedLanguageCode = $this->normalizeLanguageCode($languageCode);
        if ($normalizedLanguageCode === '') {
            return [];
        }

        return [$normalizedLanguageCode];
    }

    protected function normalizeSupportedTargetLanguages(array $languageCodes): array
    {
        $normalizedLanguageCodes = [];
        foreach ($languageCodes as $languageCode) {
            foreach ($this->mapSupportedTargetLanguageCode((string)$languageCode) as $mappedLanguageCode) {
                if ($mappedLanguageCode !== '') {
                    $normalizedLanguageCodes[$mappedLanguageCode] = true;
                }
            }
        }

        $supportedTargetLanguages = \array_keys($normalizedLanguageCodes);
        \sort($supportedTargetLanguages);

        return $supportedTargetLanguages;
    }

    protected function executeCurlRequest(string $url, array $options = []): array
    {
        $headers = [];
        $handle = \curl_init();

        \curl_setopt_array(
            $handle,
            \array_replace([
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 15,
                CURLOPT_HEADERFUNCTION => static function ($curlHandle, string $headerLine) use (&$headers): int {
                    $trimmedHeader = \trim($headerLine);

                    if ($trimmedHeader === '' || \strpos($trimmedHeader, ':') === false) {
                        return \strlen($headerLine);
                    }

                    [$name, $value] = \explode(':', $trimmedHeader, 2);
                    $headers[\strtolower(\trim($name))] = \trim($value);

                    return \strlen($headerLine);
                },
            ], $options)
        );

        $body = \curl_exec($handle);
        $error = null;
        if ($body === false) {
            $error = \curl_error($handle);
            $body = '';
        }

        $statusCode = (int)\curl_getinfo($handle, CURLINFO_HTTP_CODE);
        \curl_close($handle);

        return [
            'statusCode' => $statusCode,
            'body' => $body,
            'headers' => $headers,
            'error' => $error,
        ];
    }

    protected function extractApiErrorMessage(string $responseBody, string $fallbackMessage): string
    {
        $decodedResponse = \json_decode($responseBody, true);
        if (!\is_array($decodedResponse)) {
            return $fallbackMessage;
        }

        if (isset($decodedResponse['message']) && \is_string($decodedResponse['message'])) {
            return $decodedResponse['message'];
        }

        if (isset($decodedResponse['error']['message']) && \is_string($decodedResponse['error']['message'])) {
            return $decodedResponse['error']['message'];
        }

        if (isset($decodedResponse['detail']) && \is_string($decodedResponse['detail'])) {
            return $decodedResponse['detail'];
        }

        return $fallbackMessage;
    }
}
