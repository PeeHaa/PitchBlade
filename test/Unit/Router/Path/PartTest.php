<?php

namespace PitchBladeTest\Unit\Router;

use PitchBlade\Router\Path\Part;

class PartTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\Path\Part::__construct
     */
    public function testCOnstructCorrectInterface()
    {
        $part = new Part('foo');

        $this->assertInstanceOf('\\PitchBlade\\Router\\Path\\Segment', $part);
    }

    /**
     * @covers PitchBlade\Router\Path\Part::__construct
     * @covers PitchBlade\Router\Path\Part::parse
     */
    public function testParse()
    {
        $part = new Part('foo');

        $this->assertNull($part->parse());
    }

    /**
     * @covers PitchBlade\Router\Path\Part::__construct
     * @covers PitchBlade\Router\Path\Part::parse
     * @covers PitchBlade\Router\Path\Part::hasVariableStartIdentifier
     * @covers PitchBlade\Router\Path\Part::hasVariableEndIdentifier
     * @covers PitchBlade\Router\Path\Part::isVariable
     */
    public function testIsVariableTrue()
    {
        $part = new Part('{foo}');
        $part->parse();

        $this->assertTrue($part->isVariable());
    }

    /**
     * @covers PitchBlade\Router\Path\Part::__construct
     * @covers PitchBlade\Router\Path\Part::parse
     * @covers PitchBlade\Router\Path\Part::hasVariableStartIdentifier
     * @covers PitchBlade\Router\Path\Part::hasVariableEndIdentifier
     * @covers PitchBlade\Router\Path\Part::isVariable
     */
    public function testIsVariableFalseMissingStart()
    {
        $part = new Part('foo}');
        $part->parse();

        $this->assertFalse($part->isVariable());
    }

    /**
     * @covers PitchBlade\Router\Path\Part::__construct
     * @covers PitchBlade\Router\Path\Part::parse
     * @covers PitchBlade\Router\Path\Part::hasVariableStartIdentifier
     * @covers PitchBlade\Router\Path\Part::hasVariableEndIdentifier
     * @covers PitchBlade\Router\Path\Part::isVariable
     */
    public function testIsVariableFalseMissingEnd()
    {
        $part = new Part('foo}');
        $part->parse();

        $this->assertFalse($part->isVariable());
    }

    /**
     * @covers PitchBlade\Router\Path\Part::__construct
     * @covers PitchBlade\Router\Path\Part::parse
     * @covers PitchBlade\Router\Path\Part::hasVariableStartIdentifier
     * @covers PitchBlade\Router\Path\Part::hasVariableEndIdentifier
     * @covers PitchBlade\Router\Path\Part::isVariable
     */
    public function testIsVariableFalse()
    {
        $part = new Part('foo');
        $part->parse();

        $this->assertFalse($part->isVariable());
    }

    /**
     * @covers PitchBlade\Router\Path\Part::__construct
     * @covers PitchBlade\Router\Path\Part::parse
     * @covers PitchBlade\Router\Path\Part::isOptional
     */
    public function testIsOptionalWithEmptyValue()
    {
        $part = new Part('');
        $part->parse();

        $this->assertTrue($part->isOptional());
    }

    /**
     * @covers PitchBlade\Router\Path\Part::__construct
     * @covers PitchBlade\Router\Path\Part::parse
     * @covers PitchBlade\Router\Path\Part::isOptional
     */
    public function testIsOptionalTrue()
    {
        $part = new Part('{foo?}');
        $part->parse();

        $this->assertTrue($part->isOptional());
    }

    /**
     * @covers PitchBlade\Router\Path\Part::__construct
     * @covers PitchBlade\Router\Path\Part::parse
     * @covers PitchBlade\Router\Path\Part::isOptional
     */
    public function testIsOptionalFalseNoVariable()
    {
        $part = new Part('foo?}');
        $part->parse();

        $this->assertFalse($part->isOptional());
    }

    /**
     * @covers PitchBlade\Router\Path\Part::__construct
     * @covers PitchBlade\Router\Path\Part::parse
     * @covers PitchBlade\Router\Path\Part::isOptional
     */
    public function testIsOptionalFalse()
    {
        $part = new Part('foo');
        $part->parse();

        $this->assertFalse($part->isOptional());
    }

    /**
     * @covers PitchBlade\Router\Path\Part::__construct
     * @covers PitchBlade\Router\Path\Part::parse
     * @covers PitchBlade\Router\Path\Part::isOptional
     */
    public function testIsOptionalVariable()
    {
        $part = new Part('{foo?}');
        $part->parse();

        $this->assertTrue($part->isVariable());
        $this->assertTrue($part->isOptional());
    }

    /**
     * @covers PitchBlade\Router\Path\Part::__construct
     * @covers PitchBlade\Router\Path\Part::parse
     * @covers PitchBlade\Router\Path\Part::getValue
     */
    public function testGetValueEmpty()
    {
        $part = new Part('');
        $part->parse();

        $this->assertSame('', $part->getValue());
    }

    /**
     * @covers PitchBlade\Router\Path\Part::__construct
     * @covers PitchBlade\Router\Path\Part::parse
     * @covers PitchBlade\Router\Path\Part::getValue
     */
    public function testGetValueStatic()
    {
        $part = new Part('foo');
        $part->parse();

        $this->assertSame('foo', $part->getValue());
    }

    /**
     * @covers PitchBlade\Router\Path\Part::__construct
     * @covers PitchBlade\Router\Path\Part::parse
     * @covers PitchBlade\Router\Path\Part::getValue
     */
    public function testGetValueMissingStartVariableIdentifier()
    {
        $part = new Part('foo}');
        $part->parse();

        $this->assertSame('foo}', $part->getValue());
    }

    /**
     * @covers PitchBlade\Router\Path\Part::__construct
     * @covers PitchBlade\Router\Path\Part::parse
     * @covers PitchBlade\Router\Path\Part::getValue
     */
    public function testGetValueMissingEndVariableIdentifier()
    {
        $part = new Part('{foo');
        $part->parse();

        $this->assertSame('{foo', $part->getValue());
    }

    /**
     * @covers PitchBlade\Router\Path\Part::__construct
     * @covers PitchBlade\Router\Path\Part::parse
     * @covers PitchBlade\Router\Path\Part::getValue
     */
    public function testGetValueVariable()
    {
        $part = new Part('{foo}');
        $part->parse();

        $this->assertSame('foo', $part->getValue());
    }

    /**
     * @covers PitchBlade\Router\Path\Part::__construct
     * @covers PitchBlade\Router\Path\Part::parse
     * @covers PitchBlade\Router\Path\Part::getValue
     */
    public function testGetValueOptionalVariable()
    {
        $part = new Part('{foo?}');
        $part->parse();

        $this->assertSame('foo', $part->getValue());
    }
}
