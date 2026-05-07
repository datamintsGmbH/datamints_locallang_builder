<?php

namespace Datamints\DatamintsLocallangBuilder\Controller;

use Datamints\DatamintsLocallangBuilder\Controller\Traits\CallActionMethodTrait;
use Datamints\DatamintsLocallangBuilder\Utility\DatabaseUtility;
use Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits\{ExtensionRepositoryTrait,
    LocallangRepositoryTrait,
    TranslationRepositoryTrait,
    TranslationValueRepositoryTrait};
use Datamints\DatamintsLocallangBuilder\Mvc\View\JsonView;
use Datamints\DatamintsLocallangBuilder\Service\Traits\{CachesServiceTrait, ProviderServiceTrait};
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class ApplicationController extends AbstractController
{
    use CallActionMethodTrait;
    use ExtensionRepositoryTrait;
    use LocallangRepositoryTrait;
    use TranslationRepositoryTrait;
    use TranslationValueRepositoryTrait;
    use CachesServiceTrait;
    use ProviderServiceTrait;

    public function initializeClearAction()
    {
        $this->defaultViewObjectName = JsonView::class;
    }

    public function initializeProviderStatusAction()
    {
        $this->defaultViewObjectName = JsonView::class;
    }

    /**
     * main Action
     * Entry-Point transfer some basic configuration towards the vue-app
     *
     * @return ResponseInterface
     * @throws \TYPO3\CMS\Core\Package\Exception
     */
    public function mainAction():ResponseInterface
    {
        $extensionVersion = ExtensionManagementUtility::getExtensionVersion($this->request->getControllerExtensionKey());
        $moduleTemplate = GeneralUtility::makeInstance(ModuleTemplateFactory::class)->create($this->request);
        $this->logger->info("Opened the translate-module.");
        $moduleTemplate->assignMultiple([
            'version' => $extensionVersion,
            'config' => \json_encode( // Add everything config related stuff to give vue access to it
                [
                    'version' => $extensionVersion,
                    'provider' => $this->providerService->getConfiguredProvider(),
                    'gitUrl' => $this->settings['vue']['git_url'],
                    'allowedExtensions' => $this->settings['allowedExtensions'] ?? '',
                    'excludedExtensions' => $this->settings['excludedExtensions'],
                    'documentationUrl' => $this->settings['vue']['documentation_url'],
                ]
            ),
        ]);
        $moduleTemplate->setTitle(
            LocalizationUtility::translate('mlang_tabs_tab', 'datamints_locallang_builder') ?? 'Locallang Builder'
        );

        return $moduleTemplate->renderResponse('Application/Main');
    }

    /**
     * clear Action
     * clears all related extension related db-tables when requested by e.g. reimport-action
     *
     * @return ResponseInterface
     */
    public function clearAction():ResponseInterface
    {
        // Cleaning up...
        $this->cachesService->clearOwnCache();
        $this->extensionRepository->removeAllQuick();
        $this->locallangRepository->removeAllQuick();
        $this->translationRepository->removeAllQuick();
        $this->translationValueRepository->removeAllQuick();

        DatabaseUtility::persistAll();

        return $this->jsonResponse(json_encode(['message' => 'All database-tables have been reset to zero.']));
    }

    public function providerStatusAction(): ResponseInterface
    {
        $providerStatus = $this->providerService->getConfiguredProviderStatus();
        $response = $this->getDefaultViewAssigns();
        $response['message'] = $providerStatus['message'];
        $response['data'] = $providerStatus;

        return $this->jsonResponse(\json_encode($response));
    }
}
