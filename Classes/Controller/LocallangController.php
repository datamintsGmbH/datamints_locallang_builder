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
 * This file is part of the "datamints_locallang_builder" Extension for TYPO3 CMS.
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
    use LocallangRepositoryTrait;

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
        $this->logger->info("Triggering export of locallang-file " . $locallang->getFilename() . ' with uid ' . $locallang->getUid());
        $exportConfiguration = json_decode(GeneralUtility::_GP('data'), true);
        if($exportConfiguration['triggerBackup'] === true && $exportConfiguration['selectedTarget'] === 'overwrite') {

            // Check if we have to create a backup before overwriting. Its only possible in case of overwriting extension files. When "custom"" is selected, theres no need to do that!
            $this->backupService->backupLocallang($locallang);
        }

        // Exporting files either to "custom" or overwriting live locallang-files
        $savedFiles = $this->exportService->export($locallang, $exportConfiguration);
        if($exportConfiguration['triggerCache'] === true && $exportConfiguration['selectedTarget'] === 'overwrite') {

            // Clears cache to reload new language-files straight with the next render-call
            $this->cachesService->clearSiteCache();
            $this->logger->info("Cleared site cache");
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
}
