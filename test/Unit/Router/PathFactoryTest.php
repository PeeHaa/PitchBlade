<?php

namespace PitchBladeTest\Unit\Router;

use PitchBlade\Router\PathFactory;

class PathFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testConstructCorrectInterface()
    {
        $pathFactory = new PathFactory();

        $this->assertInstanceOf('\\PitchBlade\\Router\\PathBuilder', $pathFactory);
    }

    /**
     * @covers PitchBlade\Router\RouteFactory::__construct
     * @covers PitchBlade\Router\RouteFactory::build
     */
    public function testBuild()
    {
        $pathFactory = new PathFactory();

        $this->assertInstanceOf('\\PitchBlade\\Router\\PathParser', $pathFactory->build('/test'));
    }
}
