<?php

namespace Datamints\DatamintsLocallangBuilder\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ApplicationController extends AbstractController
{
    use \Datamints\DatamintsLocallangBuilder\Controller\Traits\CallActionMethodTrait;

    use \Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits\ExtensionRepositoryTrait;
    use \Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits\LocallangRepositoryTrait;
    use \Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits\TranslationRepositoryTrait;
    use \Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits\TranslationValueRepositoryTrait;
    use \Datamints\DatamintsLocallangBuilder\Service\Traits\CachesServiceTrait;
    use \Datamints\DatamintsLocallangBuilder\Service\Traits\ProviderServiceTrait;


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
