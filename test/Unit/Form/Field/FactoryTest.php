<?php

namespace PitchBladeTest\Unit\Form\Field;

use PitchBlade\Form\Field\Factory;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructCorrectInterface()
    {
        $factory = new Factory();

        $this->assertInstanceOf('\\PitchBlade\\Form\\Field\\Builder', $factory);
    }

    /**
     * @covers PitchBlade\Form\Field\Factory::build
     */
    public function testBuildCustomField()
    {
        $factory = new Factory();

        $this->assertInstanceOf(
            '\\PitchBlade\\Form\\Field\\Generic',
            $factory->build('dummyField', ['type' => '\\PitchBladeTest\\Mocks\\Form\\Field\\Dummy'])
        );
    }

    /**
     * @covers PitchBlade\Form\Field\Factory::build
     */
    public function testBuildStandardField()
    {
        $factory = new Factory();

        $this->assertInstanceOf(
            '\\PitchBlade\\Form\\Field\\Generic',
            $factory->build('textField', ['type' => 'text'])
        );
    }

    /**
     * @covers PitchBlade\Form\Field\Factory::build
     */
    public function testBuildThrowsExceptionForUnsupportField()
    {
        $factory = new Factory();

        $this->setExpectedException('\\PitchBlade\\Form\\Field\\InvalidFieldException');

        $factory->build('dummyField', ['type' => '\\PitchBlade\\Form\\Field\\UnsupportedField']);
    }
}
