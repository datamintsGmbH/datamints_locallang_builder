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
use Datamints\DatamintsLocallangBuilder\Services\AbstractService;
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
     * Not required by any provider
     */
    protected function getVersion(): string
    {
        return "1.0";
    }
}
