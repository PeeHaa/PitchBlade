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
    public function testAdd()
    {
        $routes = new Routes(new RouteFactory());

        $this->assertNull($routes->add('name', '/path/of/route', [], 'view', []));
    }

    /**
     * @covers PitchBlade\Router\Routes::__construct
     * @covers PitchBlade\Router\Routes::add
     */
    public function testAddWithEmptyDefaults()
    {
        $routes = new Routes(new RouteFactory());

        $this->assertNull($routes->add('name', '/path/of/route', [], 'view', [], []));
    }

    /**
     * @covers PitchBlade\Router\Routes::__construct
     * @covers PitchBlade\Router\Routes::add
     * @covers PitchBlade\Router\Routes::getRouteByName
     */
    public function testGetRouteByNameValid()
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
    public function testGetRouteByUnknownNameFail()
    {
        $routes = new Routes(new RouteFactory());

        $this->setExpectedException('\\PitchBlade\\Router\\InvalidRouteException');

        $routes->getRouteByName('name');
    }

    /**
     * @covers PitchBlade\Router\Routes::__construct
     * @covers PitchBlade\Router\Routes::getRouteByRequest
     */
    public function testGetRouteByRequest()
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
    public function testGetRouteByRequestFail()
    {
        $routes = new Routes(new RouteFactory());

        $routes->add('name', '/path/of/route', ['test' => false], 'view', []);

        $this->setExpectedException('\\PitchBlade\\Router\\InvalidRouteException');

        $routes->getRouteByRequest();
    }
}
