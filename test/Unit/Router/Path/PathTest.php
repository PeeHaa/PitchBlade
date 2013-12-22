<?php

namespace PitchBladeTest\Unit\Router\Path;

use PitchBlade\Router\Path\Path;

class PathTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\Path\Path::__construct
     */
    public function testConstructCorrectInterface()
    {
        $path = new Path('my/awesome/path');
        $this->assertInstanceOf('\\PitchBlade\\Router\\Path\\Parser', $path);
    }

    /**
     * @covers PitchBlade\Router\Path\Path::__construct
     * @covers PitchBlade\Router\Path\Path::parse
     * @covers PitchBlade\Router\Path\Path::getParts
     */
    public function testParse()
    {
        $path = new Path('/my/awesome/path');

        $factory = $this->getMock('\\PitchBlade\\Router\\Path\\SegmentBuilder');
        $factory->expects($this->any())
            ->method('build')
            ->will($this->returnArgument(0));

        $path->parse($factory);

        $parts = $path->getParts();

        $this->assertSame(3, count($parts));
        $this->assertSame('my', $parts[0]);
        $this->assertSame('awesome', $parts[1]);
        $this->assertSame('path', $parts[2]);
    }
}
