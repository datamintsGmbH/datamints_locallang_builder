<?php
declare(strict_types=1);

namespace Datamints\DatamintsLocallangBuilder\Tests\Unit\Controller;

use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 *
 * @author Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 */
class TranslationValueControllerTest extends UnitTestCase
{
	/**
	 * @var \Datamints\DatamintsLocallangBuilder\Controller\TranslationValueController
	 */
	protected $subject;

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenTranslationValueToView()
	{
		$translationValue = new \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue();

		$view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
		$this->inject($this->subject, 'view', $view);
		$view->expects(self::once())->method('assign')->with('translationValue', $translationValue);

		$this->subject->showAction($translationValue);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenTranslationValueToTranslationValueRepository()
	{
		$translationValue = new \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue();

		$translationValueRepository = $this->getMockBuilder(\Datamints\DatamintsLocallangBuilder\Domain\Repository\TranslationValueRepository::class)
			->setMethods(['add'])
			->disableOriginalConstructor()
			->getMock();

		$translationValueRepository->expects(self::once())->method('add')->with($translationValue);
		$this->inject($this->subject, 'translationValueRepository', $translationValueRepository);

		$this->subject->createAction($translationValue);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenTranslationValueToView()
	{
		$translationValue = new \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue();

		$view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
		$this->inject($this->subject, 'view', $view);
		$view->expects(self::once())->method('assign')->with('translationValue', $translationValue);

		$this->subject->editAction($translationValue);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenTranslationValueInTranslationValueRepository()
	{
		$translationValue = new \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue();

		$translationValueRepository = $this->getMockBuilder(\Datamints\DatamintsLocallangBuilder\Domain\Repository\TranslationValueRepository::class)
			->setMethods(['update'])
			->disableOriginalConstructor()
			->getMock();

		$translationValueRepository->expects(self::once())->method('update')->with($translationValue);
		$this->inject($this->subject, 'translationValueRepository', $translationValueRepository);

		$this->subject->updateAction($translationValue);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenTranslationValueFromTranslationValueRepository()
	{
		$translationValue = new \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue();

		$translationValueRepository = $this->getMockBuilder(\Datamints\DatamintsLocallangBuilder\Domain\Repository\TranslationValueRepository::class)
			->setMethods(['remove'])
			->disableOriginalConstructor()
			->getMock();

		$translationValueRepository->expects(self::once())->method('remove')->with($translationValue);
		$this->inject($this->subject, 'translationValueRepository', $translationValueRepository);

		$this->subject->deleteAction($translationValue);
    }

	protected function setUp()
	{
		parent::setUp();
		$this->subject = $this->getMockBuilder(\Datamints\DatamintsLocallangBuilder\Controller\TranslationValueController::class)
			->setMethods(['redirect', 'forward', 'addFlashMessage'])
			->disableOriginalConstructor()
			->getMock();
	}

	protected function tearDown()
	{
		parent::tearDown();
	}
}
