<?php

namespace Datamints\DatamintsLocallangBuilder\Controller;

use TYPO3\CMS\Core\Utility\ClassNamingUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Extension;
use Datamints\DatamintsLocallangBuilder\Services\Traits\ExtensionServiceTrait;
use Datamints\DatamintsLocallangBuilder\Services\Traits\FileServiceTrait;
use Datamints\DatamintsLocallangBuilder\Mvc\View\ExtensionJsonView;

/**
 * This file is part of the "locallang-xlf" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de>
 * ExtensionController
 */
class ExtensionController extends AbstractController
{
	use ExtensionServiceTrait;
	use FileServiceTrait;
	use \Datamints\DatamintsLocallangBuilder\Services\Traits\CachesServiceTrait;
	use \Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits\ExtensionRepositoryTrait;

	/**
	 * Using JSon-View-Output indead of html-Templates
	 *
	 * @var string
	 */
	public $defaultViewObjectName = ExtensionJsonView::class;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->entityType = Extension::class;
	}

	/**
	 * action list
	 * Fetches all active extensions and returns them with their related locallang-files. There are no translations inside the locallangs.
	 * Those have to be fetches in an different (LocallangController::show) call, to save some memory-space
	 * The Cache can be invoked by triggering the cache-clear button in typo3 backend
	 *
	 * @param Datamints\DatamintsLocallangBuilder\Domain\Model\Extension
	 *
	 * @return void
	 */
	public function listAction()
	{
		if($this->cachesService->has('extensionListResponse')) {
			$cacheContent = json_decode($this->cachesService->get('extensionListResponse'), true);
			foreach ($cacheContent as $fieldKey => $fieldValue) {
				$this->view->assign($fieldKey, $fieldValue);
			}
		} else {
			$extensionList = $this->extensionService->getExtensionManifest($this->fileService->getExtensionsList());
			$this->view->assign('message', count($extensionList) . ' active extensions have been loaded');
			$this->view->assign('data', $extensionList);
		}
	}

	/**
	 * action show
	 *
	 * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Extension $extension
	 *
	 * @return string|object|null|void
	 */
	public function showAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\Extension $extension)
	{
		$this->view->assign('extension', $extension);
	}

	/**
	 * action edit
	 *
	 * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Extension $extension
	 * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("extension")
	 *
	 * @return string|object|null|void
	 */
	public function editAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\Extension $extension)
	{
		$this->view->assign('extension', $extension);
	}

	/**
	 * action update
	 *
	 * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Extension $extension
	 *
	 * @return string|object|null|void
	 */
	public function updateAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\Extension $extension)
	{
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->extensionRepository->update($extension);
        $this->redirect('list');
    }
}
