<?php

namespace Datamints\DatamintsLocallangBuilder\Controller;


use Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits\LocallangRepositoryTrait;
use Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits\TranslationRepositoryTrait;
use Datamints\DatamintsLocallangBuilder\Mvc\View\TranslationJsonView;
use Datamints\DatamintsLocallangBuilder\Service\Traits\TranslationServiceTrait;
use Datamints\DatamintsLocallangBuilder\Utility\DatabaseUtility;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This file is part of the "datamints_locallang_builder" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 * TranslationController
 */
class TranslationController extends AbstractController
{
    use \Datamints\DatamintsLocallangBuilder\Controller\Traits\CallActionMethodTrait;

    use TranslationServiceTrait;
    use TranslationRepositoryTrait;
    use LocallangRepositoryTrait;


    /**
     * translationRepository
     *
     * @var \Datamints\DatamintsLocallangBuilder\Domain\Repository\TranslationRepository
     */
    protected $translationRepository = null;

    /**
     * action update
     * Updates the given fields for a translation record
     * Not existing fields results to error-response
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Translation $translation
     * @return \Psr\Http\Message\ResponseInterface
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("translation")
     *
     */
    public function updateAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\Translation $translation
    ): ResponseInterface {
        $data = json_decode(GeneralUtility::_GP('data'), true);
        $message = 'The following fields have been updated: ';
        foreach ($data as $key => $changingField) {
            if ($translation->_hasProperty($key)) {
                $translation->_setProperty($key, $changingField);
                $message .= $key . ' ';
            } else {
                $message .= ' / ERROR: ' . $key . ' / ';
                // Should never happen, but who knows
            }
        }
        $this->translationRepository->upgrade($translation);

        return $this->jsonResponse(\json_encode(['message' => $message, 'data' => $translation]));
    }

    /**
     * action delete
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Translation $translation
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("translation")
     *
     */
    public function deleteAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\Translation $translation
    ): ResponseInterface {
        $uidDeleted = $translation->getUid();
        $this->translationRepository->remove($translation);

        return $this->jsonResponse(
            \json_encode(
                [
                    'status' => 'success',
                    'requestTime' => time(),
                    'type' => null,
                    'return' => $uidDeleted,
                    'data' => [],
                    'message' => "The Entity with uid " . $uidDeleted . ' has been deleted.'
                ]
            )
        );
    }

    /**
     * action create
     * Creates a new translation record
     * It is possible to choose the default values for "approved" and "xmlSpace". See data post.
     * It's also possible to trigger an autotranslate for the configured auto-translation provider. See docs for further instructions to get auto-translation working.
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \TYPO3\CMS\Core\Exception
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("locallang")
     *
     */
    public function createAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang
    ): ResponseInterface {
        $data = json_decode(GeneralUtility::_GP('data'), true);

        // Creating the blank Translation-object
        $translation = $this->translationService->createTranslation(
            $locallang,
            $data['newObjectKey'],
            $data['newObjectValue'],
            $data['newObjectApproved'],
            $data['newObjectXmlSpace']
        );
        DatabaseUtility::persistAll();

        // Appending the TranslationValue-Objects to the Translation-Object
        if ($data['newObjectLanguages']) {
            foreach ($data['newObjectLanguages'] as $language) {
                $translationValue = $this->translationService->createTranslationValue(
                    $translation,
                    $language,
                    $data['newObjectApproved'] ?? true,
                    $data['newObjectXmlSpace']
                );
                $translationValue->setNew(true);

                // Check if we have to autotranslate this new Object...
                if ($data['newObjectAutoTranslate'] === true) {
                    $this->translationService->translate($translationValue, $data['newObjectValue']);
                }
            }
        }

        // Persist all records to receive the final uids for all objects, so vue knows how to handle them in runtime
        $this->translationRepository->add($translation);
        $this->locallangRepository->update($locallang);
        DatabaseUtility::persistAll();
        $translation->setNew(true);

        return $this->jsonResponse(
            \json_encode(
                [
                    'return' => $locallang->getUid(),
                    'message' => 'A new entity has been generated',
                    'data' => $translation,
                    "status" => "success",
                    "type" => null,
                    "requestType" => time(),
                ]
            )
        );
    }

    /**
     * action list
     *
     * @return string|object|null|void
     */
    public function listAction()
    {
        $translations = $this->translationRepository->findAll();
        $this->view->assign('translations', $translations);
    }

    /**
     * action show
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Translation $translation
     *
     * @return string|object|null|void
     */
    public function showAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\Translation $translation)
    {
        $this->view->assign('translation', $translation);
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
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Translation $translation
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("translation")
     *
     * @return string|object|null|void
     */
    public function editAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\Translation $translation)
    {
        $this->view->assign('translation', $translation);
    }

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Repository\TranslationRepository $translationRepository
     */
    public function injectTranslationRepository(
        \Datamints\DatamintsLocallangBuilder\Domain\Repository\TranslationRepository $translationRepository
    ) {
        $this->translationRepository = $translationRepository;
    }
}
