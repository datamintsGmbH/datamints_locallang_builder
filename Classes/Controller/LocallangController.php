<?php

namespace Datamints\DatamintsLocallangBuilder\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang;
use Datamints\DatamintsLocallangBuilder\Mvc\View\LocallangJsonView;
use Datamints\DatamintsLocallangBuilder\Services\Traits\BackupServiceTrait;
use Datamints\DatamintsLocallangBuilder\Services\Traits\ExportServiceTrait;
use Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits\LocallangRepositoryTrait;
use Datamints\DatamintsLocallangBuilder\Services\Traits\CachesServiceTrait;

/**
 * This file is part of the "locallang-xlf" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 * LocallangController
 */
class LocallangController extends AbstractController
{
    use BackupServiceTrait;
    use CachesServiceTrait;
    use ExportServiceTrait;

    /**
     * Using JSon-View-Output indead of html-Templates
     *
     * @var string
     */
    public $defaultViewObjectName = LocallangJsonView::class;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->entityType = Locallang::class;
    }

    /**
     * action show
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("locallang")
     *
     * @return string|object|null|void
     */
    public function showAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang)
    {
        $this->view->assign('message', "The file " . $locallang->getFilename() . " for the extension " . $locallang->getRelatedExtension()->getName() . " has been loaded");
        $this->view->assign('data', $locallang);
    }

    /**
     * action export
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("locallang")
     *
     * @return string|object|null|void
     */
    public function exportAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang)
    {
        $exportConfiguration = json_decode(GeneralUtility::_GP('data'), true);
        if($exportConfiguration['triggerBackup'] === true && $exportConfiguration['selectedTarget'] === 'overwrite') {

            // Check if we have to create a backup before overwriting. Its only possible in case of overwriting extension files. When fileadmin is selected, theres no need to do that!
            $this->backupService->backupLocallang($locallang);
        }

        // Exporting files either to fileadmin or overwriting live locallang-files
        $savedFiles = $this->exportService->export($locallang, $exportConfiguration);
        if($exportConfiguration['triggerCache'] === true && $exportConfiguration['selectedTarget'] === 'overwrite') {

            // Clears cache to reload new language-files straight with the next render-call
            $this->cachesService->clearSiteCache();
        }
        $this->view->assign('message', 'Exported files were saved to: ' . implode('; ', $savedFiles));
    }

    /**
     * action list
     *
     * @return string|object|null|void
     */
    public function listAction()
    {
        $locallangs = $this->locallangRepository->findAll();
        $this->view->assign('locallangs', $locallangs);
    }

    /**
     * action new
     *
     * @return string|object|null|void
     */
    public function newAction()
    {
    }

    /**
     * action create
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $newLocallang
     *
     * @return string|object|null|void
     */
    public function createAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $newLocallang)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->locallangRepository->add($newLocallang);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("locallang")
     *
     * @return string|object|null|void
     */
    public function editAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang)
    {
        $this->view->assign('locallang', $locallang);
    }

    /**
     * action update
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang
     *
     * @return string|object|null|void
     */
    public function updateAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->locallangRepository->update($locallang);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang
     *
     * @return string|object|null|void
     */
    public function deleteAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->locallangRepository->remove($locallang);
        $this->redirect('list');
    }
}
