<?php

namespace Datamints\DatamintsLocallangBuilder\Controller;


use Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang;
use Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits\LocallangRepositoryTrait;
use Datamints\DatamintsLocallangBuilder\Mvc\View\LocallangJsonView;
use Datamints\DatamintsLocallangBuilder\Service\Traits\BackupServiceTrait;
use Datamints\DatamintsLocallangBuilder\Service\Traits\CachesServiceTrait;
use Datamints\DatamintsLocallangBuilder\Service\Traits\ExportServiceTrait;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This file is part of the "datamints_locallang_builder" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 * LocallangController
 */
class LocallangController extends AbstractController
{
    use \Datamints\DatamintsLocallangBuilder\Controller\Traits\CallActionMethodTrait;

    use BackupServiceTrait;
    use CachesServiceTrait;
    use ExportServiceTrait;
    use LocallangRepositoryTrait;

    /**
     * Using JSon-View-Output indead of html-Templates
     *
     * @var string
     */
    protected $defaultViewObjectName = LocallangJsonView::class;

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
     * @return \Psr\Http\Message\ResponseInterface
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("locallang")
     *
     */
    public function showAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang
    ): ResponseInterface {
        $response = [
            'message' => "The file " . $locallang->getFilename(
                ) . " for the extension " . $locallang->getRelatedExtension()->getName() . " has been loaded",
            "data" => $locallang,
            "status" => "success",
            "type" => "Datamints\\DatamintsLocallangBuilder\\Domain\\Model\\Locallang",
            "requestType" => time(),
            "return" => null
        ];
        return $this->jsonResponse(json_encode($response));

    }

    /**
     * action export
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang
     * @return \Psr\Http\Message\ResponseInterface
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("locallang")
     *
     */
    public function exportAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang
    ): ResponseInterface {
        $this->logger->info(
            "Triggering export of locallang-file " . $locallang->getFilename() . ' with uid ' . $locallang->getUid()
        );
        $exportConfiguration = json_decode(GeneralUtility::_GP('data'), true);
        if ($exportConfiguration['triggerBackup'] === true && $exportConfiguration['selectedTarget'] === 'overwrite') {
            // Check if we have to create a backup before overwriting. Its only possible in case of overwriting extension files. When "custom"" is selected, theres no need to do that!
            $this->backupService->backupLocallang($locallang);
        }

        // Exporting files either to "custom" or overwriting live locallang-files
        $savedFiles = $this->exportService->export($locallang, $exportConfiguration);
        if ($exportConfiguration['triggerCache'] === true && $exportConfiguration['selectedTarget'] === 'overwrite') {
            // Clears cache to reload new language-files straight with the next render-call
            $this->cachesService->clearSiteCache();
            $this->logger->info("Cleared site cache");
        };
        return $this->jsonResponse(
            json_encode(['message' => 'Exported files were saved to: ' . implode('; ', $savedFiles)])
        );
    }
}
