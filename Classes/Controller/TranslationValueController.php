<?php

namespace Datamints\DatamintsLocallangBuilder\Controller;

use Exception;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use Datamints\DatamintsLocallangBuilder\Utility\DatabaseUtility;
use Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue;
use Datamints\DatamintsLocallangBuilder\Domain\Repository\Traits\TranslationRepositoryTrait;
use Datamints\DatamintsLocallangBuilder\Mvc\View\TranslationValueJsonView;
use Datamints\DatamintsLocallangBuilder\Services\Traits\TranslationServiceTrait;

/**
 * This file is part of the "locallang builder" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * (c) 2021 Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 * TranslationValueController
 */
class TranslationValueController extends AbstractController
{
	use TranslationServiceTrait;
	use TranslationRepositoryTrait;

	/**
	 * Using JSon-View-Output indead of html-Templates
	 *
	 * @var string
	 */
	public $defaultViewObjectName = TranslationValueJsonView::class;

	/**
	 * translationValueRepository
	 *
	 * @var \Datamints\DatamintsLocallangBuilder\Domain\Repository\TranslationValueRepository
	 */
	protected $translationValueRepository = null;

	/**
	 * @param \Datamints\DatamintsLocallangBuilder\Domain\Repository\TranslationValueRepository $translationValueRepository
	 */
	public function injectTranslationValueRepository(\Datamints\DatamintsLocallangBuilder\Domain\Repository\TranslationValueRepository $translationValueRepository)
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
	public function showAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValue)
	{
		$this->view->assign('translationValue', $translationValue);
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
	 * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\Translation $translation
	 * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("translation")
	 *
	 * @return string|object|null|void
	 */
	public function createAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\Translation $translation)
	{
		$data = json_decode(GeneralUtility::_GP('data'), true);
		if(!$data['value']) {
			throw new Exception('No Ident given');
		}

		/** @var TranslationValue $newTranslationValue */
		$translationValue = $this->translationService->createTranslationValue($translation, strtolower($data['value']));
		if($data['autoTranslate'] === true) {
			$translationValue = $this->translationService->translate($translationValue, $data['textToTranslate']);
		}
		$this->translationRepository->update($translation);
		DatabaseUtility::persistAll();

		// todo remove fallback
		$this->view->assign('message', 'A new translation with language code: ' . $translationValue->getIdent() . ' has been created.');
		$this->view->assign('data', $translationValue);
		$this->view->assign('return', $translation->getUid());
	}

	/**
	 * action update
	 * Changes given values, if they exist in model
	 *
	 * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValue
	 * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("translationValue")
	 *
	 * @return string|object|null|void
	 */
	public function updateAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValue)
	{
		$data = json_decode(GeneralUtility::_GP('data'), true);
		$message = 'The following fields have been updated: ';
		foreach ($data as $key => $changingField) {
			if($translationValue->_hasProperty($key)) {
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
		$this->view->assign('message', $message);
		$this->view->assign('data', $translationValue);
	}

	/**
	 * action delete
	 *
	 * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValue
	 * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("translationValue")
	 *
	 * @return string|object|null|void
	 */
	public function deleteAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValue)
	{
		$uidDeleted = $translationValue->getUid();
		$identDeleted = $translationValue->getIdent();
		$this->translationValueRepository->remove($translationValue);
		$this->view->assign('return', $uidDeleted);
		$this->view->assign('data', []);
		$this->view->assign('message', "The Entity with uid " . $uidDeleted . ' and language-code ' . $identDeleted . ' has been deleted.');
	}

	/**
	 * Autotranslates an entity by the selected translator-provider
	 * action autoTranslate
	 *
	 * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValue
	 * @param string                                                             $textToTranslate
	 * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("translationValue")
	 *
	 * @return string|object|null|void
	 */
	public function autoTranslateAction(TranslationValue $translationValue, string $textToTranslate)
	{
		$translationValue = $this->translationService->translate($translationValue, $textToTranslate);
		$this->translationValueRepository->update($translationValue);
		$this->view->assign('data', $translationValue);
	}

	/**
	 * action edit
	 *
	 * @param \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValue
	 * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("translationValue")
	 *
	 * @return string|object|null|void
	 */
	public function editAction(\Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue $translationValue)
	{
		$this->view->assign('translationValue', $translationValue);
    }
}
