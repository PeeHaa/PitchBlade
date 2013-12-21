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
}
