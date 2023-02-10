<?php

namespace Datamints\DatamintsLocallangBuilder\Controller;

use Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue;
use Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits\TranslationRepositoryTrait;
use Datamints\DatamintsLocallangBuilder\Mvc\View\TranslationValueJsonView;
use Datamints\DatamintsLocallangBuilder\Service\Traits\TranslationServiceTrait;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This file is part of the "locallang builder" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 * TranslationValueController
 */
class TranslationValueController extends AbstractController
{
    use \Datamints\DatamintsLocallangBuilder\Controller\Traits\CallActionMethodTrait;
    use TranslationServiceTrait;
    use TranslationRepositoryTrait;

    /**
     * translationValueRepository
     *
     * @var \Datamints\DatamintsLocallangBuilder\Domain\Repository\TranslationValueRepository
     */
    protected $translationValueRepository = null;

    /**
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Repository\TranslationValueRepository $translationValueRepository
     */
    public function injectTranslationValueRepository (\Datamints\DatamintsLocallangBuilder\Domain\Repository\TranslationValueRepository $translationValueRepository)
    {
        $this->translationValueRepository = $translationValueRepository;
    }

    /**
     * action show
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValue
     *
     * @return string|object|null|void
     */
    public function showAction (\Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValue)
    {
        $this->view->assign('translationValue', $translationValue);
    }

    /**
     * action new
     *
     * @return string|object|null|void
     */
    public function newAction ()
    {
    }

    /**
     * action create
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Translation $translation
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \TYPO3\CMS\Core\Exception
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("translation")
     *
     */
    public function createAction (\Datamints\DatamintsLocallangBuilder\Domain\Model\Translation $translation):ResponseInterface
    {
        $data = json_decode(GeneralUtility::_GP('data'), true);
        if (!$data['value']) {
            throw new Exception('The action "create" could not be executed: No language given as argument');
        }
        if (is_array($data['value'])) {

            /** @var TranslationValue $newTranslationValue */
            foreach ($data['value'] as $languageToAdd) {
                $translationValue = $this->translationService->createTranslationValue($translation, strtolower($languageToAdd));
                if ($data['autoTranslate'] === true) {
                    $translationValue = $this->translationService->translate($translationValue, $data['textToTranslate']);
                }
            }
        }
        $this->translationRepository->update($translation);
        DatabaseUtility::persistAll();

        return $this->jsonResponse(\json_encode(['return' => $translation->getUid(),'message' => 'A new translation with language code: ' . $translationValue->getIdent() . ' has been created.', 'data' => $translationValue]));

    }

    /**
     * action update
     * Changes given values, if they exist in model
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValue
     * @return \Psr\Http\Message\ResponseInterface
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("translationValue")
     *
     */
    public function updateAction (\Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValue):ResponseInterface
    {
        $data = json_decode(GeneralUtility::_GP('data'), true);
        $message = 'The following fields have been updated: ';
        foreach ($data as $key => $changingField) {
            if ($translationValue->_hasProperty($key)) {
                $translationValue->_setProperty($key, $changingField);
                $message .= $key . ' ';
            } else {
                $message .= ' / ERROR: ' . $key . ' / ';

                // Should never happen, but who knows
            }
        }
        $this->translationValueRepository->upgrade($translationValue);

        // we "fake" a tstamp-value duo to the fact, that we otherwise have to get the translationValue-Entity from the repo again, to get the correct value.
        // The tstamp is required for vue to display the "last updated on"-flag
        $translationValue->setTstamp(new \DateTime());

        return $this->jsonResponse(\json_encode(['message' => $message, 'data' => $translationValue]));

    }

    /**
     * action delete
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValue
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("translationValue")
     *
     */
    public function deleteAction (\Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValue):ResponseInterface
    {
        $uidDeleted = $translationValue->getUid();
        $identDeleted = $translationValue->getIdent();
        $this->translationValueRepository->remove($translationValue);
        return $this->jsonResponse(\json_encode(['message' => "The Entity with uid " . $uidDeleted . ' and language-code ' . $identDeleted . ' has been deleted.', 'return' => $uidDeleted, 'data' => []]));

    }

    /**
     * Autotranslates an entity by the selected translator-provider
     * action autoTranslate
     *
     * @param \Datamints\DatamintsLocallangBuilder\Controller\TranslationValue $translationValue
     * @param string $textToTranslate
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \TYPO3\CMS\Core\Exception
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("translationValue")
     *
     */
    public function autoTranslateAction (TranslationValue $translationValue, string $textToTranslate):ResponseInterface
    {
        $translationValue = $this->translationService->translate($translationValue, $textToTranslate);
        $this->translationValueRepository->update($translationValue);
        return $this->jsonResponse(\json_encode(['data' => $translationValue]));

    }

    /**
     * action edit
     *
     * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValue
     * @return \Psr\Http\Message\ResponseInterface
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("translationValue")
     *
     */
    public function editAction (\Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValue):ResponseInterface
    {
        return $this->jsonResponse(\json_encode(['translationValue' => $translationValue]));
    }
}
