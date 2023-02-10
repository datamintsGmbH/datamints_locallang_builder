<?php

namespace Datamints\DatamintsLocallangBuilder\Controller;

use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Extbase\Mvc\RequestInterface;
use Psr\Log\LoggerAwareTrait;

/**
 * This file is part of the "datamints_locallang_builder" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 * ExtensionController
 */
class AbstractController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController implements \Psr\Log\LoggerAwareInterface
{
    use LoggerAwareTrait;

    const STATUS_SUCCESS = 'success';
    const STATUS_ERROR = 'danger';

    protected $entityType = null;

    /**
     * set Default-Values
     *
     */
    protected function initializeView ()
    {
        $this->view->assignMultiple(
            $this->getDefaultViewAssigns()
        );
    }

    /**
     * Default-view response vars, if the request gets canceled before execution finish
     *
     * @return array{status: string, message: string, data:array,requestTime:int, type:string}
     * @see initializeView
     */
    protected function getDefaultViewAssigns (): array
    {
        $context = GeneralUtility::makeInstance(Context::class);

        return [
            'status' => self::STATUS_SUCCESS,
            'message' => 'Could not execute the command. Try again later or check the API-Key',
            'data' => [],
            'requestTime' => $context->getPropertyFromAspect('date', 'timestamp'),
            'type' => $this->entityType,
        ];
    }
}
