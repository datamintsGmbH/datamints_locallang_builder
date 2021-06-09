<?php


namespace Datamints\DatamintsLocallangBuilder\Provider;

/* * *************************************************************
 * This file is part of the "locallang builder" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 * ************************************************************* */

use Datamints\DatamintsLocallangBuilder\Utility\LogUtility;
use Exception;
use TYPO3\CMS\Extbase\{DomainObject\DomainObjectInterface, Persistence\RepositoryInterface};
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;


class GoogleProvider extends AbstractProvider
{


    /**
     * @see \TYPO3\CMS\Extbase\Mvc\View\JsonView::setVariablesToRender()
     */
    public function getName(): string
    {
        return "Google";
    }

    protected function getApiPath(): string
    {
        return $this->getSettings()['providers']['google']['url'];
    }

    protected function getUrlArguments(): string
    {
        return '/' . $this->getVersion();
    }

    protected function getVersion(): string
    {
        return $this->getSettings()['providers']['google']['version'];
    }

    protected function getKey(): string
    {
        return $this->getSettings()['providers']['google']['key'];
    }

    protected function extractResponse($response): string
    {
        try {
            $response = json_decode($response, true);
            // DebuggerUtility::var_dump($response);
            // die();
            // i dont know why, but we have to loop through the response from google
            foreach ($response['data'] as $responseEntry) {

                // and again to get the value. Maybe its possible to translate multiple strings at once, but we dont need this
                foreach ($responseEntry as $responseTranslation) {
                    if($responseTranslation['translatedText']) {
                        return $responseTranslation['translatedText']; // we got our requested value
                    }
                }

            }
            return 'No text found';
        } catch (Exception $e) {
            // TODO - pass response from api
            return 'Error';
        }
    }

    protected function stream(string $url, $key, $params, $content): string
    {
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url . $params);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($handle, CURLOPT_POSTFIELDS, ['key' => $key, 'q' => $content, 'source' => 'en', 'target' => $this->payload['to']]);
        curl_setopt($handle, CURLOPT_HTTPHEADER, ['X-HTTP-Method-Override: GET']);
        $response = curl_exec($handle);
        LogUtility::log(self::class . ': API CALL ||| URL:' . $url . $params . ' ||| Content: ' . $content);
        curl_close($handle);

        return $response;
    }

    protected function getContent(): string
    {
        return $this->text;

    }
}
