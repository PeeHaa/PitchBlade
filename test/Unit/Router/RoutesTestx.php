<?php

namespace PitchBladeTest\Unit\Router;

use PitchBladeTest\Mocks\Router\RouteFactory,
    PitchBlade\Router\Routes;

class RoutesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\Routes::__construct
     */
    public function testConstructCorrectInterface()
    {
        $routes = new Routes(new RouteFactory());

        $this->assertInstanceOf('\\PitchBlade\\Router\\Routable', $routes);
    }

    /**
     * @covers PitchBlade\Router\Routes::__construct
     * @covers PitchBlade\Router\Routes::add
     */
    public function xtestAdd()
    {
        $routes = new Routes(new RouteFactory());

        $this->assertNull($routes->add('name', '/path/of/route', [], 'view', []));
    }

    /**
     * @covers PitchBlade\Router\Routes::__construct
     * @covers PitchBlade\Router\Routes::add
     */
    public function xtestAddWithEmptyDefaults()
    {
        $routes = new Routes(new RouteFactory());

        $this->assertNull($routes->add('name', '/path/of/route', [], 'view', [], []));
    }

    /**
     * @covers PitchBlade\Router\Routes::__construct
     * @covers PitchBlade\Router\Routes::add
     * @covers PitchBlade\Router\Routes::getRouteByName
     */
    public function xtestGetRouteByNameValid()
    {
        $routes = new Routes(new RouteFactory());
        $routes->add('name', '/path/of/route', [], 'view', []);

        $route = $routes->getRouteByName('name');

        $this->assertInstanceOf('\\PitchBladeTest\\Mocks\\Router\\Route', $route);
        $this->assertSame('name', $route->getName());
    }

    /**
     * @covers PitchBlade\Router\Routes::__construct
     * @covers PitchBlade\Router\Routes::getRouteByName
     */
    public function xtestGetRouteByUnknownNameFail()
    {
        $routes = new Routes(new RouteFactory());

        $this->setExpectedException('\\PitchBlade\\Router\\InvalidRouteException');

        $routes->getRouteByName('name');
    }

    /**
     * @covers PitchBlade\Router\Routes::__construct
     * @covers PitchBlade\Router\Routes::getRouteByRequest
     */
    public function xtestGetRouteByRequest()
    {
        $routes = new Routes(new RouteFactory());

        $routes->add('name', '/path/of/route', ['test' => true], 'view', []);

        $route = $routes->getRouteByRequest();

        $this->assertInstanceOf('\\PitchBladeTest\\Mocks\\Router\\Route', $route);
        $this->assertSame('name', $route->getName());
    }

    /**
     * @covers PitchBlade\Router\Routes::__construct
     * @covers PitchBlade\Router\Routes::getRouteByRequest
     */
    public function xtestGetRouteByRequestFail()
    {
        $routes = new Routes(new RouteFactory());

        $routes->add('name', '/path/of/route', ['test' => false], 'view', []);

        $this->setExpectedException('\\PitchBlade\\Router\\InvalidRouteException');

        $routes->getRouteByRequest();
    }
}
