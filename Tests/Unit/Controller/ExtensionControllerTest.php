<?php
declare(strict_types=1);

namespace Datamints\DatamintsLocallangBuilder\Tests\Unit\Controller;

use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 *
 * @author Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 */
class ExtensionControllerTest extends UnitTestCase
{
	/**
	 * @var \Datamints\DatamintsLocallangBuilder\Controller\ExtensionController
	 */
	protected $subject;

	/**
	 * @test
	 */
	public function listActionFetchesAllExtensionsFromRepositoryAndAssignsThemToView()
	{
		$allExtensions = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
			->disableOriginalConstructor()
			->getMock();

		$extensionRepository = $this->getMockBuilder(\Datamints\DatamintsLocallangBuilder\Domain\Repository\ExtensionRepository::class)
			->setMethods(['findAll'])
			->disableOriginalConstructor()
			->getMock();
		$extensionRepository->expects(self::once())->method('findAll')->will(self::returnValue($allExtensions));
		$this->inject($this->subject, 'extensionRepository', $extensionRepository);

		$view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
		$view->expects(self::once())->method('assign')->with('extensions', $allExtensions);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenExtensionToView()
	{
		$extension = new \Datamints\DatamintsLocallangBuilder\Domain\Model\Extension();

		$view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
		$this->inject($this->subject, 'view', $view);
		$view->expects(self::once())->method('assign')->with('extension', $extension);

		$this->subject->showAction($extension);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenExtensionToView()
	{
		$extension = new \Datamints\DatamintsLocallangBuilder\Domain\Model\Extension();

		$view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
		$this->inject($this->subject, 'view', $view);
		$view->expects(self::once())->method('assign')->with('extension', $extension);

		$this->subject->editAction($extension);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenExtensionInExtensionRepository()
	{
		$extension = new \Datamints\DatamintsLocallangBuilder\Domain\Model\Extension();

		$extensionRepository = $this->getMockBuilder(\Datamints\DatamintsLocallangBuilder\Domain\Repository\ExtensionRepository::class)
			->setMethods(['update'])
			->disableOriginalConstructor()
			->getMock();

		$extensionRepository->expects(self::once())->method('update')->with($extension);
		$this->inject($this->subject, 'extensionRepository', $extensionRepository);

		$this->subject->updateAction($extension);
    }

	protected function setUp()
	{
		parent::setUp();
		$this->subject = $this->getMockBuilder(\Datamints\DatamintsLocallangBuilder\Controller\ExtensionController::class)
			->setMethods(['redirect', 'forward', 'addFlashMessage'])
			->disableOriginalConstructor()
			->getMock();
	}

	protected function tearDown()
	{
		parent::tearDown();
	}
}
