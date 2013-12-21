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
        $routeFactory = $this->getMock('\\PitchBlade\\Router\\Route\\Builder');
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
        $router = new Router($this->getMock('\\PitchBlade\\Router\\Route\\Builder'));

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
        $routeFactory = $this->getMock('\\PitchBlade\\Router\\Route\\Builder');
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
        $router = new Router($this->getMock('\\PitchBlade\\Router\\Route\\Builder'));

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
        $routeFactory = $this->getMock('\\PitchBlade\\Router\\Route\\Builder');
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

    /**
     * @covers PitchBlade\Router\Router::__construct
     * @covers PitchBlade\Router\Router::getRoute
     */
    public function testGetRouteThrowsOnUnsupportedMethod()
    {
        $router = new Router($this->getMock('\\PitchBlade\\Router\\Route\\Builder'));

        $this->setExpectedException('\\PitchBlade\\Router\\UnsupportedMethodException');

        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->any())
            ->method('getMethod')
            ->will($this->returnValue('UNSUPPORTED'));

        $router->getRoute($request);
    }

    /**
     * @covers PitchBlade\Router\Router::__construct
     * @covers PitchBlade\Router\Router::get
     * @covers PitchBlade\Router\Router::addRoute
     * @covers PitchBlade\Router\Router::getRoute
     */
    public function testGetRouteFoundFirst()
    {
        $routeFactory = $this->getMock('\\PitchBlade\\Router\\Route\\Builder');
        $routeFactory->expects($this->at(0))
            ->method('build')
            ->will($this->returnCallback(function() {
                $route = $this->getMock('\\PitchBlade\\Router\\Route\\AccessPoint');
                $route->expects($this->once())
                    ->method('matchesRequest')
                    ->will($this->returnValue(true));

                return $route;
            }));

        $router = new Router($routeFactory);

        $router->get('foo', '/foo', function() {});

        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->any())
            ->method('getMethod')
            ->will($this->returnValue('GET'));

        $this->assertInstanceOf('\\PitchBlade\\Router\\Route\\AccessPoint', $router->getRoute($request));
    }

    /**
     * @covers PitchBlade\Router\Router::__construct
     * @covers PitchBlade\Router\Router::get
     * @covers PitchBlade\Router\Router::addRoute
     * @covers PitchBlade\Router\Router::getRoute
     */
    public function testGetRouteFoundSecond()
    {
        $routeFactory = $this->getMock('\\PitchBlade\\Router\\Route\\Builder');
        $routeFactory->expects($this->at(0))
            ->method('build')
            ->will($this->returnCallback(function() {
                $route = $this->getMock('\\PitchBlade\\Router\\Route\\AccessPoint');
                $route->expects($this->once())
                    ->method('matchesRequest')
                    ->will($this->returnValue(false));

                return $route;
            }));
        $routeFactory->expects($this->at(1))
            ->method('build')
            ->will($this->returnCallback(function() {
                $route = $this->getMock('\\PitchBlade\\Router\\Route\\AccessPoint');
                $route->expects($this->once())
                    ->method('matchesRequest')
                    ->will($this->returnValue(true));

                return $route;
            }));

        $router = new Router($routeFactory);

        $router->get('foo', '/foo', function() {});
        $router->get('bar', '/bar', function() {});

        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->any())
            ->method('getMethod')
            ->will($this->returnValue('GET'));

        $this->assertInstanceOf('\\PitchBlade\\Router\\Route\\AccessPoint', $router->getRoute($request));
    }

    /**
     * @covers PitchBlade\Router\Router::__construct
     * @covers PitchBlade\Router\Router::getRoute
     */
    public function testGetRouteThrowsNotFound()
    {
        $router = new Router($this->getMock('\\PitchBlade\\Router\\Route\\Builder'));

        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->any())
            ->method('getMethod')
            ->will($this->returnValue('GET'));

        $this->setExpectedException('\\PitchBlade\\Router\\NotFoundException');

        $router->getRoute($request);
    }

    /**
     * @covers PitchBlade\Router\Router::__construct
     * @covers PitchBlade\Router\Router::get
     * @covers PitchBlade\Router\Router::addRoute
     * @covers PitchBlade\Router\Router::getRoute
     */
    public function testGetRouteThrowsNotFoundButDoesIncludeRoute()
    {
        $routeFactory = $this->getMock('\\PitchBlade\\Router\\Route\\Builder');
        $routeFactory->expects($this->at(0))
            ->method('build')
            ->will($this->returnCallback(function() {
                $route = $this->getMock('\\PitchBlade\\Router\\Route\\AccessPoint');
                $route->expects($this->once())
                    ->method('matchesRequest')
                    ->will($this->returnValue(false));

                return $route;
            }));

        $router = new Router($routeFactory);

        $router->get('foo', '/foo', function() {});

        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->any())
            ->method('getMethod')
            ->will($this->returnValue('GET'));

        $this->setExpectedException('\\PitchBlade\\Router\\NotFoundException');

        $router->getRoute($request);
    }
}
