<?php

namespace PitchBladeTest\Unit\Router;

use PitchBlade\Router\Path;

class PathTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\Path::__construct
     */
    public function testConstructCorrectInterface()
    {
        $path = new Path('my/awesome/path');
        $this->assertInstanceOf('\\PitchBlade\\Router\\PathParser', $path);
    }
}
