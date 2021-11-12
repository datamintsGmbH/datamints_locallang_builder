<?php

namespace Datamints\DatamintsLocallangBuilder\Controller\Traits;

/**
 * Trait for error handling for legacy TYPO3 (up to v10)
 */
trait CallActionMethodLegacyTrait
{
    /**
     * Extend callActionMethod to catch errors for a valid response.
     */
    protected function callActionMethod()
    {
        try {
            parent::callActionMethod();
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());

            $result = $this->getDefaultViewAssigns();
            $result['status'] = self::STATUS_ERROR;
            $result['message'] = $exception->getMessage();

            $this->response->appendContent(json_encode($result));
        }
    }
}
