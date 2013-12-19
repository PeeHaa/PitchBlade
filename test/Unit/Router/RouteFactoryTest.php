<?php

namespace PitchBladeTest\Unit\Router;

use PitchBlade\Router\RouteFactory;

class RouteFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\RouteFactory::__construct
     */
    public function testConstructCorrectInterface()
    {
        $routeFactory = new RouteFactory($this->getMock('\\PitchBlade\\Router\\PathBuilder'));

        $this->assertInstanceOf('\\PitchBlade\\Router\\RouteBuilder', $routeFactory);
    }

    /**
     * @covers PitchBlade\Router\RouteFactory::__construct
     * @covers PitchBlade\Router\RouteFactory::build
     */
    public function testBuild()
    {
        $pathFactory = $this->getMock('\\PitchBlade\\Router\\PathBuilder');
        $pathFactory->expects($this->once())
            ->method('build')
            ->will($this->returnValue($this->getMock('\\PitchBlade\\Router\\PathParser')));

        $routeFactory = new RouteFactory($pathFactory);

        $this->assertInstanceOf('\\PitchBlade\\Router\\AccessPoint', $routeFactory->build('test', '/test', function() {
        }));
    }
}
