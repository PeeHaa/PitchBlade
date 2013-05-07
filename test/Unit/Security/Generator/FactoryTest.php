<?php

namespace PitchBladeTest\Unit\Security\Generator;

use PitchBlade\Security\Generator\Factory;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Security\Generator\Factory::build
     */
    public function testBuildCorrectInterface()
    {
        $factory = new Factory();

        $this->assertInstanceOf('\\PitchBlade\\Security\\Generator\\Builder', $factory);
    }

    /**
     * @covers PitchBlade\Security\Generator\Factory::build
     */
    public function testBuildFakeGeneratorSuccess()
    {
        $factory = new Factory();

        $this->assertInstanceOf(
            '\\PitchBlade\\Security\\Generator', $factory->build('\\PitchBladeTest\\Mocks\\Security\\Generator\\Fake')
        );
    }

    /**
     * @covers PitchBlade\Security\Generator\Factory::build
     */
    public function testBuildUnknownGeneratorFail()
    {
        $factory = new Factory();

        $this->setExpectedException('\\PitchBlade\\Security\\Generator\\InvalidGeneratorException');

        $factory->build('\\PitchBladeUnknown\\UnknownGenerator');
    }
}
