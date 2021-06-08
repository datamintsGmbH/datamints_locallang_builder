<?php

namespace Datamints\DatamintsLocallangBuilder\Controller;

use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;

/**
 * This file is part of the "locallang-xlf" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 * ExtensionController
 */
class AbstractController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
	const STATUS_SUCCESS = 'success';
	const STATUS_ERROR = 'error';

	protected $entityType = null;

	/**
	 * Default Werte für die gängigen REST-Response-Felder setzen (status, message, requestTime, type)
	 * Sind diese nicht initial gesetzt, aber in der JSON-View vorhanden, werden die durch Extbase sonst immer
	 * automatisch als leeres Array ausgegeben
	 *
	 * @param \TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view
	 */
	protected function initializeView(ViewInterface $view)
	{
		parent::initializeView($view);

		// Default Werte für die gängigen REST-Response-Felder setzen (status, message, requestTime, type)
		// Sind diese nicht initial gesetzt, aber in der JSON-View vorhanden, werden die durch Extbase sonst immer automatisch als leeres Array ausgegeben
		$view->assignMultiple(
			$this->getDefaultViewAssigns()
		);
	}


	/**
	 * Standart-View Variablen, falls z.B. vorzeitig abgebrochen werden müsste
	 *
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
}
