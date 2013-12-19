<?php

namespace PitchBladeTest\Unit\Router;

use PitchBlade\Router\Route;

class RouteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\Route::__construct
     */
    public function testConstructCorrectInterface()
    {
        $route = new Route('name', $this->getMock('\\PitchBlade\\Router\\PathParser'), function() {});

        $this->assertInstanceOf('\\PitchBlade\\Router\\Route', $route);
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::wherePattern
     */
    public function testWherePattern()
    {
        $route = new Route('name', $this->getMock('\\PitchBlade\\Router\\PathParser'), function() {});

        $this->assertInstanceOf('\\PitchBlade\\Router\\Route', $route->wherePattern(['key' => 'pattern']));
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::defaults
     */
    public function testDefaults()
    {
        $route = new Route('name', $this->getMock('\\PitchBlade\\Router\\PathParser'), function() {});

        $this->assertInstanceOf('\\PitchBlade\\Router\\Route', $route->defaults(['key' => 'value']));
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::wherePattern
     * @covers PitchBlade\Router\Route::defaults
     */
    public function testFluidInterface()
    {
        $route = new Route('name', $this->getMock('\\PitchBlade\\Router\\PathParser'), function() {});

        $this->assertInstanceOf(
            '\\PitchBlade\\Router\\Route',
            $route->wherePattern(['key' => 'pattern'])
                ->defaults(['key' => 'value'])
                ->wherePattern(['key' => 'pattern'])
        );
    }
}
