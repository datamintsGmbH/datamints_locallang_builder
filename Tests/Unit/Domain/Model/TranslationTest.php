<?php
declare(strict_types=1);

namespace Datamints\DatamintsLocallangBuilder\Tests\Unit\Domain\Model;

use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 *
 * @author Mark Weisgerber <mark.weisgerber@outlook.de>
 */
class TranslationTest extends UnitTestCase
{
    /**
     * @var \Datamints\DatamintsLocallangBuilder\Domain\Model\Translation
     */
    protected $subject;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Datamints\DatamintsLocallangBuilder\Domain\Model\Translation();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getTranslationKeyReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTranslationKey()
        );
    }

    /**
     * @test
     */
    public function setTranslationKeyForStringSetsTranslationKey()
    {
        $this->subject->setTranslationKey('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'translationKey',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTranslationValuesReturnsInitialValueForTranslationValue()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getTranslationValues()
        );
    }

    /**
     * @test
     */
    public function setTranslationValuesForObjectStorageContainingTranslationValueSetsTranslationValues()
    {
        $translationValue = new \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue();
        $objectStorageHoldingExactlyOneTranslationValues = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneTranslationValues->attach($translationValue);
        $this->subject->setTranslationValues($objectStorageHoldingExactlyOneTranslationValues);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneTranslationValues,
            'translationValues',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addTranslationValueToObjectStorageHoldingTranslationValues()
    {
        $translationValue = new \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue();
        $translationValuesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $translationValuesObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($translationValue));
        $this->inject($this->subject, 'translationValues', $translationValuesObjectStorageMock);

        $this->subject->addTranslationValue($translationValue);
    }

    /**
     * @test
     */
    public function removeTranslationValueFromObjectStorageHoldingTranslationValues()
    {
        $translationValue = new \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue();
        $translationValuesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $translationValuesObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($translationValue));
        $this->inject($this->subject, 'translationValues', $translationValuesObjectStorageMock);

        $this->subject->removeTranslationValue($translationValue);
    }

    /**
     * @test
     */
    public function getRelatedLocallangReturnsInitialValueForLocallang()
    {
        self::assertEquals(
            null,
            $this->subject->getRelatedLocallang()
        );
    }

    /**
     * @test
     */
    public function setRelatedLocallangForLocallangSetsRelatedLocallang()
    {
        $relatedLocallangFixture = new \Datamints\DatamintsLocallangBuilder\Domain\Model\Locallang();
        $this->subject->setRelatedLocallang($relatedLocallangFixture);

        self::assertAttributeEquals(
            $relatedLocallangFixture,
            'relatedLocallang',
            $this->subject
        );
    }
}
