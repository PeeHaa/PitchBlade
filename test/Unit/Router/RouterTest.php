<?php

namespace PitchBladeTest\Unit\Router;

use PitchBlade\Router\Router;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\Router::__construct
     * @covers PitchBlade\Router\Router::get
     * @covers PitchBlade\Router\Router::addRoute
     */
    public function testGet()
    {
        $routeFactory = $this->getMock('\\PitchBlade\\Router\\RouteBuilder');
        $routeFactory->expects($this->once())
            ->method('build')
            ->will($this->returnCallback(function ($name, $path, $callback) {
                return [$name, $path, $callback];
            }));

        $router = new Router($routeFactory);

        $route = $router->get('routeName', 'routePath', function () {
            return true;
        });

        $this->assertSame('routeName', $route[0]);
        $this->assertSame('routePath', $route[1]);
        $this->assertTrue($route[2]());
    }

    /**
     * @covers PitchBlade\Router\Router::__construct
     * @covers PitchBlade\Router\Router::get
     * @covers PitchBlade\Router\Router::addRoute
     */
    public function testGetThrowsOnDuplicateRoute()
    {
        $router = new Router($this->getMock('\\PitchBlade\\Router\\RouteBuilder'));

        $route = $router->get('routeName', 'routePath', function () {
            return true;
        });

        $this->setExpectedException('\\PitchBlade\\Router\\DuplicateRouteException');

        $route = $router->get('routeName', 'routePath', function () {
            return true;
        });
    }

    /**
     * @covers PitchBlade\Router\Router::__construct
     * @covers PitchBlade\Router\Router::post
     * @covers PitchBlade\Router\Router::addRoute
     */
    public function testPost()
    {
        $routeFactory = $this->getMock('\\PitchBlade\\Router\\RouteBuilder');
        $routeFactory->expects($this->once())
            ->method('build')
            ->will($this->returnCallback(function ($name, $path, $callback) {
                return [$name, $path, $callback];
            }));

        $router = new Router($routeFactory);

        $route = $router->post('routeName', 'routePath', function () {
            return true;
        });

        $this->assertSame('routeName', $route[0]);
        $this->assertSame('routePath', $route[1]);
        $this->assertTrue($route[2]());
    }

    /**
     * @covers PitchBlade\Router\Router::__construct
     * @covers PitchBlade\Router\Router::post
     * @covers PitchBlade\Router\Router::addRoute
     */
    public function testPostThrowsOnDuplicateRoute()
    {
        $router = new Router($this->getMock('\\PitchBlade\\Router\\RouteBuilder'));

        $route = $router->post('routeName', 'routePath', function () {
            return true;
        });

        $this->setExpectedException('\\PitchBlade\\Router\\DuplicateRouteException');

        $route = $router->post('routeName', 'routePath', function () {
            return true;
        });
    }

    /**
     * @covers PitchBlade\Router\Router::__construct
     * @covers PitchBlade\Router\Router::get
     * @covers PitchBlade\Router\Router::post
     * @covers PitchBlade\Router\Router::addRoute
     */
    public function testGetAndPostWithSameNameValid()
    {
        $routeFactory = $this->getMock('\\PitchBlade\\Router\\RouteBuilder');
        $routeFactory->expects($this->any())
            ->method('build')
            ->will($this->returnArgument(0));

        $router = new Router($routeFactory);

        $getRoute = $router->get('getRoute', 'routePath', function () {
            return true;
        });

        $postRoute = $router->post('postRoute', 'routePath', function () {
            return false;
        });

        $this->assertSame('getRoute', $getRoute);
        $this->assertSame('postRoute', $postRoute);
    }
}
