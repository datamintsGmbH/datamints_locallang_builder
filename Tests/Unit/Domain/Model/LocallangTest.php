<?php
declare(strict_types=1);

namespace Datamints\DatamintsLocallangBuilder\Tests\Unit\Domain\Model;

use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 *
 * @author Mark Weisgerber <mark.weisgerber@outlook.de / m.weisgerber@datamints.com>
 */
class LocallangTest extends UnitTestCase
{
	/**
	 * @var \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang
	 */
	protected $subject;

	/**
	 * @test
	 */
	public function getFilenameReturnsInitialValueForString()
	{
		self::assertSame(
			'',
			$this->subject->getFilename()
		);
	}

	/**
	 * @test
	 */
	public function setFilenameForStringSetsFilename()
	{
		$this->subject->setFilename('Conceived at T3CON10');

		self::assertAttributeEquals(
			'Conceived at T3CON10',
			'filename',
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
	public function getTranslationsReturnsInitialValueForTranslation()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		self::assertEquals(
			$newObjectStorage,
			$this->subject->getTranslations()
		);
	}

	/**
	 * @test
	 */
	public function setTranslationsForObjectStorageContainingTranslationSetsTranslations()
	{
		$translation = new \Datamints\DatamintsLocallangBuilder\Domain\Model\Translation();
		$objectStorageHoldingExactlyOneTranslations = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneTranslations->attach($translation);
		$this->subject->setTranslations($objectStorageHoldingExactlyOneTranslations);

		self::assertAttributeEquals(
			$objectStorageHoldingExactlyOneTranslations,
			'translations',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addTranslationToObjectStorageHoldingTranslations()
	{
		$translation = new \Datamints\DatamintsLocallangBuilder\Domain\Model\Translation();
		$translationsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
			->setMethods(['attach'])
			->disableOriginalConstructor()
			->getMock();

		$translationsObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($translation));
		$this->inject($this->subject, 'translations', $translationsObjectStorageMock);

		$this->subject->addTranslation($translation);
	}

	/**
	 * @test
	 */
	public function removeTranslationFromObjectStorageHoldingTranslations()
	{
		$translation = new \Datamints\DatamintsLocallangBuilder\Domain\Model\Translation();
		$translationsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
			->setMethods(['detach'])
			->disableOriginalConstructor()
			->getMock();

		$translationsObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($translation));
		$this->inject($this->subject, 'translations', $translationsObjectStorageMock);

		$this->subject->removeTranslation($translation);
	}

	/**
	 * @test
	 */
	public function getRelatedExtensionReturnsInitialValueForExtension()
	{
		self::assertEquals(
			null,
			$this->subject->getRelatedExtension()
		);
	}

	/**
	 * @test
	 */
	public function setRelatedExtensionForExtensionSetsRelatedExtension()
	{
		$relatedExtensionFixture = new \Datamints\DatamintsLocallangBuilder\Domain\Model\Extension();
		$this->subject->setRelatedExtension($relatedExtensionFixture);

		self::assertAttributeEquals(
			$relatedExtensionFixture,
			'relatedExtension',
			$this->subject
        );
    }

	protected function setUp()
	{
		parent::setUp();
		$this->subject = new \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang();
	}

	protected function tearDown()
	{
		parent::tearDown();
	}
}
