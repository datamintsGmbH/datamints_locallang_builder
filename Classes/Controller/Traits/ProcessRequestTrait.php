<?php

namespace Datamints\DatamintsLocallangBuilder\Controller\Traits;

use TYPO3\CMS\Extbase\Mvc\RequestInterface;
use TYPO3\CMS\Extbase\Mvc\ResponseInterface;

trait ProcessRequestTrait
{
    /**
     * extend ProcessRequest to catch errors for a valid response
     *
     * @override
     *
     *
     */
    protected function callActionMethod(RequestInterface $request): ResponseInterface
    {
        try {
            parent::callActionMethod($request);
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());

            $result = $this->getDefaultViewAssigns();
            $result['status'] = self::STATUS_ERROR;
            $result['message'] = $exception->getMessage();

            $this->response->appendContent(json_encode($result));
        }
    }
}
