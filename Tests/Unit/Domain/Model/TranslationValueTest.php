<?php
declare(strict_types=1);

namespace Datamints\DatamintsLocallangBuilder\Tests\Unit\Domain\Model;

use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 *
 * @author Mark Weisgerber <mark.weisgerber@outlook.de>
 */
class TranslationValueTest extends UnitTestCase
{
    /**
     * @var \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue
     */
    protected $subject;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Datamints\DatamintsLocallangBuilder\Domain\Model\TranslationValue();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getIdentReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getIdent()
        );
    }

    /**
     * @test
     */
    public function setIdentForStringSetsIdent()
    {
        $this->subject->setIdent('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'ident',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getValueReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getValue()
        );
    }

    /**
     * @test
     */
    public function setValueForStringSetsValue()
    {
        $this->subject->setValue('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'value',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getResnameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getResname()
        );
    }

    /**
     * @test
     */
    public function setResnameForStringSetsResname()
    {
        $this->subject->setResname('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'resname',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getXmlSpaceReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getXmlSpace()
        );
    }

    /**
     * @test
     */
    public function setXmlSpaceForStringSetsXmlSpace()
    {
        $this->subject->setXmlSpace('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'xmlSpace',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getApprovedReturnsInitialValueForBool()
    {
        self::assertSame(
            false,
            $this->subject->getApproved()
        );
    }

    /**
     * @test
     */
    public function setApprovedForBoolSetsApproved()
    {
        $this->subject->setApproved(true);

        self::assertAttributeEquals(
            true,
            'approved',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getCommentReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getComment()
        );
    }

    /**
     * @test
     */
    public function setCommentForStringSetsComment()
    {
        $this->subject->setComment('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'comment',
            $this->subject
        );
    }
}
