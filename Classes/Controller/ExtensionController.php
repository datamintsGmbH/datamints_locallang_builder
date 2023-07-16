<?php

namespace Datamints\DatamintsLocallangBuilder\Controller;


use Datamints\DatamintsLocallangBuilder\Domain\Model\Extension;
use Datamints\DatamintsLocallangBuilder\Mvc\View\ExtensionJsonView;
use Datamints\DatamintsLocallangBuilder\Service\Traits\ExtensionServiceTrait;
use Datamints\DatamintsLocallangBuilder\Service\Traits\FileServiceTrait;
use Psr\Http\Message\ResponseInterface;

/**
 * This file is part of the "datamints_locallang_builder" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 * ExtensionController
 */
class ExtensionController extends AbstractController
{
    use \Datamints\DatamintsLocallangBuilder\Controller\Traits\CallActionMethodTrait;
    use ExtensionServiceTrait;
    use FileServiceTrait;
    use \Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits\ExtensionRepositoryTrait;
    use \Datamints\DatamintsLocallangBuilder\Service\Traits\CachesServiceTrait;

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
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction():ResponseInterface
    {
        $response = [];
        if($this->cachesService->has('extensionListResponse')) {
            $this->logger->info("Creating or refreshing the extension-cache.");
            $cacheContent = json_decode($this->cachesService->get('extensionListResponse'), true);
            foreach ($cacheContent as $fieldKey => $fieldValue) {
                $response[$fieldKey] = $fieldValue;
            }
        } else {
            $this->logger->info("Forwarding the extension-cache");
            $extensionList = $this->extensionService->getExtensionManifest($this->fileService->getExtensionsList());
            $response['message'] = count($extensionList) . ' active extensions have been loaded';


            $response['data'] = $extensionList;
            $response['status'] = "success";

        }
        // Remove the unnecessary translations that are not yet necessary to save RAM. Due to the removal of the JsonView in TYPO3 12.x, these fields are no longer skipped automatically.
        $response = \json_encode($response);
        $response = \json_decode($response, true);
        $response['return'] = null;
        $response['type'] = "Datamints\\DatamintsLocallangBuilder\\Domain\\Model\\Extension";
        $response['requestTime'] = time();

        foreach ($response['data'] as &$extension){
            foreach ($extension['locallangs'] as &$locallang){
                unset($locallang['translationsArray']);

            }
        }
        return $this->jsonResponse(\json_encode($response));
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
        $this->redirect('list');
    }
}
