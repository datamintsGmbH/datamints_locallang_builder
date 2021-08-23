<?php

namespace Datamints\DatamintsLocallangBuilder\Controller;

use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Extbase\Mvc\RequestInterface;
use TYPO3\CMS\Extbase\Mvc\ResponseInterface;
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
     * extend ProcessRequest to catch errors for a valid response
     *
     * @override
     *
     * @param \TYPO3\CMS\Extbase\Mvc\RequestInterface  $request  The request object
     * @param \TYPO3\CMS\Extbase\Mvc\ResponseInterface $response The response, modified by this handler
     *
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     */
    public function processRequest(RequestInterface $request, ResponseInterface $response)
    {
        try {
            parent::processRequest($request, $response);
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());

            $result = $this->getDefaultViewAssigns();
            $result['status'] = self::STATUS_ERROR;
            $result['message'] = $exception->getMessage();

            $response->appendContent(json_encode($result));
        }
    }

    /**
     * Default-view response vars, if the request gets canceled before execution finish
     *
     * @return array{status: string, message: string, data:array,requestTime:int, type:string}
     * @see initializeView
     */
    protected function getDefaultViewAssigns(): array
    {
        $context = GeneralUtility::makeInstance(Context::class);

        return [
            'status' => self::STATUS_SUCCESS,
            'message' => 'no message given',
            'data' => [],
            'requestTime' => $context->getPropertyFromAspect('date', 'timestamp'),
            'type' => $this->entityType,
        ];
    }

    /**
     * set Default-Values
     *
     * @param \TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view
     */
    protected function initializeView(ViewInterface $view)
    {
        parent::initializeView($view);

        $view->assignMultiple(
            $this->getDefaultViewAssigns()
        );
    }
}
