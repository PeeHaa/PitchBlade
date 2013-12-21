<?php

namespace PitchBladeTest\Unit\Router\Route;

use PitchBlade\Router\Route\Route;

class RouteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\Route\Route::__construct
     */
    public function testConstructCorrectInterface()
    {
        $route = new Route('name', $this->getMock('\\PitchBlade\\Router\\Path\\Parser'), function () {});

        $this->assertInstanceOf('\\PitchBlade\\Router\\Route\\AccessPoint', $route);
    }

    /**
     * @covers PitchBlade\Router\Route\Route::__construct
     * @covers PitchBlade\Router\Route\Route::wherePattern
     */
    public function testWherePattern()
    {
        $route = new Route('name', $this->getMock('\\PitchBlade\\Router\\Path\\Parser'), function () {});

        $this->assertInstanceOf('\\PitchBlade\\Router\\Route\\Route', $route->wherePattern(['key' => 'pattern']));
    }

    /**
     * @covers PitchBlade\Router\Route\Route::__construct
     * @covers PitchBlade\Router\Route\Route::defaults
     */
    public function testDefaults()
    {
        $route = new Route('name', $this->getMock('\\PitchBlade\\Router\\Path\\Parser'), function () {});

        $this->assertInstanceOf('\\PitchBlade\\Router\\Route\\Route', $route->defaults(['key' => 'value']));
    }

    /**
     * @covers PitchBlade\Router\Route\Route::__construct
     * @covers PitchBlade\Router\Route\Route::wherePattern
     * @covers PitchBlade\Router\Route\Route::defaults
     */
    public function testFluidInterface()
    {
        $route = new Route('name', $this->getMock('\\PitchBlade\\Router\\Path\\Parser'), function () {});

        $this->assertInstanceOf(
            '\\PitchBlade\\Router\\Route\\Route',
            $route->wherePattern(['key' => 'pattern'])
                ->defaults(['key' => 'value'])
                ->wherePattern(['key' => 'pattern'])
        );
    }
}
