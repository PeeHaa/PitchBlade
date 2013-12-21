<?php

namespace PitchBladeTest\Unit\Router\Route;

use PitchBlade\Router\Route\Factory;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\Route\Factory::__construct
     */
    public function testConstructCorrectInterface()
    {
        $routeFactory = new Factory($this->getMock('\\PitchBlade\\Router\\Path\\Builder'));

        $this->assertInstanceOf('\\PitchBlade\\Router\\Route\\Builder', $routeFactory);
    }

    /**
     * @covers PitchBlade\Router\Route\Factory::__construct
     * @covers PitchBlade\Router\Route\Factory::build
     */
    public function testBuild()
    {
        $pathFactory = $this->getMock('\\PitchBlade\\Router\\Path\\Builder');
        $pathFactory->expects($this->once())
            ->method('build')
            ->will($this->returnValue($this->getMock('\\PitchBlade\\Router\\Path\\Parser')));

        $routeFactory = new Factory($pathFactory);

        $this->assertInstanceOf('\\PitchBlade\\Router\\Route\\AccessPoint', $routeFactory->build('test', '/test', function () {
        }));
    }
}
