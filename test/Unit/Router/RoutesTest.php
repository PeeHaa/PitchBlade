<?php

namespace PitchBladeTest\Unit\Router;

use PitchBladeTest\Mocks\Router\RouteFactory,
    PitchBladeTest\Mocks\Http\Request,
    PitchBlade\Router\Routes;

class RoutesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\Routes::__construct
     * @covers PitchBlade\Router\Routes::add
     */
    public function testAdd()
    {
        $routes = new Routes(new RouteFactory());

        $this->assertNull($routes->add('name', [], 'view', []));
    }

    /**
     * @covers PitchBlade\Router\Routes::__construct
     * @covers PitchBlade\Router\Routes::add
     */
    public function testAddWithEmptyMapping()
    {
        $routes = new Routes(new RouteFactory());

        $this->assertNull($routes->add('name', [], 'view', [], []));
    }

    /**
     * @covers PitchBlade\Router\Routes::__construct
     * @covers PitchBlade\Router\Routes::add
     * @covers PitchBlade\Router\Routes::getRouteByName
     */
    public function testGetRouteByNameValid()
    {
        $routes = new Routes(new RouteFactory());
        $routes->add('name', [], 'view', []);

        $this->assertSame('nametest', $routes->getRouteByName('name'));
    }

    /**
     * @covers PitchBlade\Router\Routes::__construct
     * @covers PitchBlade\Router\Routes::getRouteByName
     */
    public function testGetRouteByUnknownNameFail()
    {
        $routes = new Routes(new RouteFactory());

        $this->setExpectedException('\\PitchBlade\\Router\\InvalidRouteException');

        $routes->getRouteByName('name');
    }
}
