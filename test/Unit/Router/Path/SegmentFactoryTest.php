<?php

namespace PitchBladeTest\Unit\Router\Path;

use PitchBlade\Router\Path\SegmentFactory;

class SegmentFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testConstructCorrectInterface()
    {
        $factory = new SegmentFactory();

        $this->assertInstanceOf('\\PitchBlade\\Router\\Path\\SegmentBuilder', $factory);
    }

    /**
     * @covers PitchBlade\Router\Path\SegmentFactory::build
     */
    public function testBuild()
    {
        $factory = new SegmentFactory();

        $this->assertInstanceOf('\\PitchBlade\\Router\\Path\\Segment', $factory->build('/test'));
    }
}
