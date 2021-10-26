<?php

namespace Datamints\DatamintsLocallangBuilder\Controller\Traits;

trait ProcessRequestLegacyTrait
{
    /**
     * extend ProcessRequest to catch errors for a valid response
     *
     * @override
     *
     *
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
