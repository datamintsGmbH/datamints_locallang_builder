<?php

namespace Datamints\DatamintsLocallangBuilder\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Datamints\DatamintsLocallangBuilder\Domain\Model\Translation;
use Datamints\DatamintsLocallangBuilder\Utility\DatabaseUtility;
use Datamints\DatamintsLocallangBuilder\Mvc\View\TranslationJsonView;
use Datamints\DatamintsLocallangBuilder\Services\Traits\TranslationServiceTrait;
use Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits\LocallangRepositoryTrait;
use Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits\TranslationRepositoryTrait;

/**
 * This file is part of the "datamints_locallang_builder" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 * TranslationController
 */
class TranslationController extends AbstractController
{
    use TranslationServiceTrait;
    use TranslationRepositoryTrait;
    use LocallangRepositoryTrait;

    /**
     * Using JSon-View-Output indead of html-Templates
     *
     * @var string
     */
    public $defaultViewObjectName = TranslationJsonView::class;

    /**
     * action update
     *
     * Updates the given fields for a translation record
     * Not existing fields results to error-response
     *
     * @param Weisgerber\LocallangBuilder\Domain\Model\Translation
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("translation")
     *
     * @return string|object|null|void
     */
    public function updateAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\Translation $translation)
    {
        $data = json_decode(GeneralUtility::_GP('data'), true);
        $message = 'The following fields have been updated: ';
        foreach ($data as $key => $changingField) {
            if($translation->_hasProperty($key)) {
                $translation->_setProperty($key, $changingField);
                $message .= $key . ' ';
            } else {
                $message .= ' / ERROR: ' . $key . ' / ';

                // Should never happen, but who knows
            }
        }
        $this->translationRepository->upgrade($translation);
        $this->view->assign('message', $message);
        $this->view->assign('data', $translation);
    }

    /**
     * action delete
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Translation $translation
     *
     * @return string|object|null|void
     */
    public function deleteAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\Translation $translation)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->translationRepository->remove($translation);
        $this->redirect('list');
    }

    /**
     * action create
     *
     * Creates a new translation record
     * It is possible to choose the default values for "approved" and "xmlSpace". See data post.
     * It's also possible to trigger an autotranslate for the configured auto-translation provider. See docs for further instructions to get auto-translation working.
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("locallang")
     *
     * @return string|object|null|void
     */
    public function createAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang $locallang)
    {
        $data = json_decode(GeneralUtility::_GP('data'), true);
        if(!$data['newObjectLanguages']) {
            throw new \Exception('The action "create" could not be executed: No language given.');
        }
        // Creating the blank Translation-object
        $translation = $this->translationService->createTranslation($locallang, $data['newObjectKey'], $data['newObjectValue'], $data['newObjectApproved'], $data['newObjectXmlSpace']);
        DatabaseUtility::persistAll();

        // Appending the TranslationValue-Objects to the Translation-Object
        foreach ($data['newObjectLanguages'] as $language) {
            $translationValue = $this->translationService->createTranslationValue($translation, $language, $data['newObjectApproved'], $data['newObjectXmlSpace']);
            $translationValue->setNew(true);

            // Check if we have to autotranslate this new Object...
            if($data['newObjectAutoTranslate'] === true) {
                $this->translationService->translate($translationValue, $data['newObjectValue']);
            }
        }

        // Persist all records to receive the final uids for all objects, so vue knows how to handle them in runtime
        $this->translationRepository->add($translation);
        $this->locallangRepository->update($locallang);
        DatabaseUtility::persistAll();

        $translation->setNew(true);
        $this->view->assign('return', $locallang->getUid());
        $this->view->assign('data', $translation);
        $this->view->assign('message', 'A new entity has been generated');
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
}
