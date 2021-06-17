<?php

namespace Datamints\DatamintsLocallangBuilder\Log\Processor;


use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;

class BackendUserProcessor extends \TYPO3\CMS\Core\Log\Processor\AbstractProcessor implements \TYPO3\CMS\Core\Log\Processor\ProcessorInterface
{

    /**
     * Adding backend username to log record
     *
     * @inheritDoc
     */
    public function processLogRecord(\TYPO3\CMS\Core\Log\LogRecord $logRecord)
    {

        /** @var BackendUserAuthentication $backenduserAuthentication */
        $backenduserAuthentication = $GLOBALS['BE_USER'];
        $logRecord->addData(['user' => $backenduserAuthentication->user['username']]);
        return $logRecord;
    }
}
