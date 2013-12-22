<?php

namespace PitchBladeTest\Unit\Router\Path;

use PitchBlade\Router\Path\Factory;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\Path\Factory::__construct
     */
    public function testConstructCorrectInterface()
    {
        $pathFactory = new Factory($this->getMock('\\PitchBlade\\Router\\Path\\SegmentBuilder'));

        $this->assertInstanceOf('\\PitchBlade\\Router\\Path\\Builder', $pathFactory);
    }

    /**
     * @covers PitchBlade\Router\Path\Factory::__construct
     * @covers PitchBlade\Router\Path\Factory::build
     */
    public function testBuild()
    {
        $pathFactory = new Factory($this->getMock('\\PitchBlade\\Router\\Path\\SegmentBuilder'));

        $this->assertInstanceOf('\\PitchBlade\\Router\\Path\\Parser', $pathFactory->build('/test'));
    }
}
