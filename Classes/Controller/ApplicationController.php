<?php

namespace Datamints\DatamintsLocallangBuilder\Controller;

use Datamints\DatamintsLocallangBuilder\Controller\Traits\CallActionMethodTrait;
use Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits\{ExtensionRepositoryTrait,
    LocallangRepositoryTrait,
    TranslationRepositoryTrait,
    TranslationValueRepositoryTrait};
use Datamints\DatamintsLocallangBuilder\Mvc\View\JsonView;
use Datamints\DatamintsLocallangBuilder\Service\Traits\{CachesServiceTrait, ProviderServiceTrait};
use Psr\Http\Message\ResponseInterface;

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

    /**
     * main Action
     *
     * Entry-Point transfer some basic configuration towards the vue-app
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \TYPO3\CMS\Core\Package\Exception
     */
    public function mainAction():ResponseInterface
    {
        $extensionVersion = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getExtensionVersion($this->request->getControllerExtensionKey());
        $this->logger->info("Opened the translate-module.");
        $this->view->assignMultiple([
            'version' => $extensionVersion,
            'config' => \json_encode( // Add everything config related stuff to give vue access to it
                [
                    'version' => $extensionVersion,
                    'provider' => $this->providerService->getConfiguredProvider(),
                    'gitUrl' => $this->settings['vue']['git_url'],
                    'excludedExtensions' => $this->settings['excludedExtensions'],
                    'documentationUrl' => $this->settings['vue']['documentation_url'],
                ]
            ),
        ]);
        return $this->htmlResponse($this->view->render());
    }

    /**
     * clear Action
     *
     * clears all related extension related db-tables when requested by e.g. reimport-action
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function clearAction():ResponseInterface
    {
        // Cleaning up...
        $this->cachesService->clearOwnCache();
        $this->extensionRepository->removeAllQuick();
        $this->locallangRepository->removeAllQuick();
        $this->translationRepository->removeAllQuick();
        $this->translationValueRepository->removeAllQuick();

        \Datamints\DatamintsLocallangBuilder\Utility\DatabaseUtility::persistAll();


        return $this->jsonResponse(json_encode(['message' => 'All database-tables have been reset to zero.']));
    }
}
