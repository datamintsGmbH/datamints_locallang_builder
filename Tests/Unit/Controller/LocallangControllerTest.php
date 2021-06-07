<?php
declare(strict_types=1);

namespace Datamints\DatamintsLocallangBuilder\Tests\Unit\Controller;

use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 *
 * @author Mark Weisgerber <mark.weisgerber@outlook.de>
 */
class LocallangControllerTest extends UnitTestCase
{
    /**
     * @var \Datamints\DatamintsLocallangBuilder\Controller\LocallangController
     */
    protected $subject;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Datamints\DatamintsLocallangBuilder\Controller\LocallangController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllLocallangsFromRepositoryAndAssignsThemToView()
    {
        $allLocallangs = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $locallangRepository = $this->getMockBuilder(\Datamints\DatamintsLocallangBuilder\Domain\Repository\LocallangRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $locallangRepository->expects(self::once())->method('findAll')->will(self::returnValue($allLocallangs));
        $this->inject($this->subject, 'locallangRepository', $locallangRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('locallangs', $allLocallangs);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenLocallangToView()
    {
        $locallang = new \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('locallang', $locallang);

        $this->subject->showAction($locallang);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenLocallangToLocallangRepository()
    {
        $locallang = new \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang();

        $locallangRepository = $this->getMockBuilder(\Datamints\DatamintsLocallangBuilder\Domain\Repository\LocallangRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $locallangRepository->expects(self::once())->method('add')->with($locallang);
        $this->inject($this->subject, 'locallangRepository', $locallangRepository);

        $this->subject->createAction($locallang);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenLocallangToView()
    {
        $locallang = new \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('locallang', $locallang);

        $this->subject->editAction($locallang);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenLocallangInLocallangRepository()
    {
        $locallang = new \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang();

        $locallangRepository = $this->getMockBuilder(\Datamints\DatamintsLocallangBuilder\Domain\Repository\LocallangRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $locallangRepository->expects(self::once())->method('update')->with($locallang);
        $this->inject($this->subject, 'locallangRepository', $locallangRepository);

        $this->subject->updateAction($locallang);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenLocallangFromLocallangRepository()
    {
        $locallang = new \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang();

        $locallangRepository = $this->getMockBuilder(\Datamints\DatamintsLocallangBuilder\Domain\Repository\LocallangRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $locallangRepository->expects(self::once())->method('remove')->with($locallang);
        $this->inject($this->subject, 'locallangRepository', $locallangRepository);

        $this->subject->deleteAction($locallang);
    }
}
