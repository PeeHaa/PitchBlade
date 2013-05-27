<?php

namespace PitchBladeTest\Unit\Router;

use PitchBladeTest\Mocks\Router\RequestMatcher,
    PitchBladeTest\Mocks\Http\Request,
    PitchBlade\Router\Route;

class RouteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::matchesRequest
     */
    public function testMatchesRequest()
    {
        $route = new Route('name', [], 'view', [], new RequestMatcher());

        $this->assertTrue($route->matchesRequest(new Request(['host' => 'http://example.com'])));
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getPath
     */
    public function testGetPath()
    {
        $route = new Route('name', ['path' => '/path'], 'view', [], new RequestMatcher());

        $this->assertSame('/path', $route->getPath());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getController
     */
    public function testGetController()
    {
        $route = new Route('name', [], 'view', ['name' => 'myController'], new RequestMatcher());

        $this->assertSame('myController', $route->getController());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getAction
     */
    public function testGetAction()
    {
        $route = new Route('name', [], 'view', ['action' => 'myAction'], new RequestMatcher());

        $this->assertSame('myAction', $route->getAction());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getController
     * @covers PitchBlade\Router\Route::getAction
     */
    public function testGetControllerAndGetAction()
    {
        $route = new Route('name', [], 'view', ['name' => 'myController', 'action' => 'myAction'], new RequestMatcher());

        $this->assertSame('myController', $route->getController());
        $this->assertSame('myAction', $route->getAction());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getDependencies
     */
    public function testGetDependenciesWithoutDependencies()
    {
        $route = new Route('name', [], 'view', [], new RequestMatcher());

        $this->assertSame([], $route->getDependencies());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getDependencies
     */
    public function testGetDependenciesWithEmptyDependencies()
    {
        $route = new Route('name', [], 'view', ['dependencies' => []], new RequestMatcher());

        $this->assertSame([], $route->getDependencies());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getDependencies
     */
    public function testGetDependenciesFilled()
    {
        $route = new Route('name', [], 'view', ['dependencies' => ['some dependency', 'another dependency']], new RequestMatcher());

        $this->assertSame(['some dependency', 'another dependency'], $route->getDependencies());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getView
     */
    public function testGetView()
    {
        $route = new Route('name', [], 'view', ['dependencies' => ['some dependency', 'another dependency']], new RequestMatcher());

        $this->assertSame('view', $route->getView());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getMapping
     */
    public function testGetMappingWithoutMapping()
    {
        $route = new Route('name', [], 'view', ['dependencies' => ['some dependency', 'another dependency']], new RequestMatcher());

        $this->assertSame([], $route->getMapping());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getMapping
     */
    public function testGetMappingWithEmptyMapping()
    {
        $route = new Route('name', [], 'view', ['dependencies' => ['some dependency', 'another dependency']], new RequestMatcher(), []);

        $this->assertSame([], $route->getMapping());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getMapping
     */
    public function testGetMappingFilled()
    {
        $route = new Route('name', [], 'view', ['dependencies' => ['some dependency', 'another dependency']], new RequestMatcher(), ['somemapping' => 0]);

        $this->assertSame(['somemapping' => 0], $route->getMapping());
    }
}
