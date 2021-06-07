<?php
declare(strict_types=1);

namespace Datamints\DatamintsLocallangBuilder\Tests\Unit\Domain\Model;

use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 *
 * @author Mark Weisgerber <mark.weisgerber@outlook.de>
 */
class ExtensionTest extends UnitTestCase
{
    /**
     * @var \Datamints\DatamintsLocallangBuilder\Domain\Model\Extension
     */
    protected $subject;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Datamints\DatamintsLocallangBuilder\Domain\Model\Extension();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );
    }

    /**
     * @test
     */
    public function setNameForStringSetsName()
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'name',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getPathReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getPath()
        );
    }

    /**
     * @test
     */
    public function setPathForStringSetsPath()
    {
        $this->subject->setPath('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'path',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLocalReturnsInitialValueForBool()
    {
        self::assertSame(
            false,
            $this->subject->getLocal()
        );
    }

    /**
     * @test
     */
    public function setLocalForBoolSetsLocal()
    {
        $this->subject->setLocal(true);

        self::assertAttributeEquals(
            true,
            'local',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLocallangsReturnsInitialValueForLocallang()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getLocallangs()
        );
    }

    /**
     * @test
     */
    public function setLocallangsForObjectStorageContainingLocallangSetsLocallangs()
    {
        $locallang = new \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang();
        $objectStorageHoldingExactlyOneLocallangs = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneLocallangs->attach($locallang);
        $this->subject->setLocallangs($objectStorageHoldingExactlyOneLocallangs);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneLocallangs,
            'locallangs',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addLocallangToObjectStorageHoldingLocallangs()
    {
        $locallang = new \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang();
        $locallangsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $locallangsObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($locallang));
        $this->inject($this->subject, 'locallangs', $locallangsObjectStorageMock);

        $this->subject->addLocallang($locallang);
    }

    /**
     * @test
     */
    public function removeLocallangFromObjectStorageHoldingLocallangs()
    {
        $locallang = new \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang();
        $locallangsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $locallangsObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($locallang));
        $this->inject($this->subject, 'locallangs', $locallangsObjectStorageMock);

        $this->subject->removeLocallang($locallang);
    }
}
