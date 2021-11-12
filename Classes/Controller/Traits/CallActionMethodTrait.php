<?php

namespace Datamints\DatamintsLocallangBuilder\Controller\Traits;

use TYPO3\CMS\Extbase\Mvc\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Trait for error handling for current TYPO3 (v11+)
 */
trait CallActionMethodTrait
{
    /**
     * Extend callActionMethod to catch errors for a valid response.
     *
     * @param \TYPO3\CMS\Extbase\Mvc\RequestInterface $request
     *
     * @return \TYPO3\CMS\Extbase\Mvc\ResponseInterface
     */
    protected function callActionMethod (RequestInterface $request): ResponseInterface
    {
        try {
            return parent::callActionMethod($request);
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());

            $result = $this->getDefaultViewAssigns();
            $result['status'] = self::STATUS_ERROR;
            $result['message'] = $exception->getMessage();

            return new \TYPO3\CMS\Core\Http\JsonResponse($result);
        }
    }
}
