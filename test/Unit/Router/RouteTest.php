<?php

namespace PitchBladeTest\Unit\Router;

use PitchBladeTest\Mocks\Router\RequestMatcher,
    PitchBladeTest\Mocks\Http\Request,
    PitchBlade\Router\Route;

class RouteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\Route::__construct
     */
    public function testConstructCorrectInterface()
    {
        $route = new Route('name', '/path/of/route', [], 'view', [], new RequestMatcher());

        $this->assertInstanceOf('\\PitchBlade\\Router\\AccessPoint', $route);
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::matchesRequest
     */
    public function testMatchesRequest()
    {
        $route = new Route('name', '/path/of/route', [], 'view', [], new RequestMatcher());

        $this->assertTrue($route->matchesRequest(new Request(['host' => 'http://example.com'])));
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getPath
     */
    public function testGetPath()
    {
        $route = new Route('name', '/path/of/route', [], 'view', [], new RequestMatcher());

        $this->assertSame('/path/of/route', $route->getPath());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getController
     */
    public function testGetController()
    {
        $route = new Route('name', '/path/of/route', [], 'view', ['name' => 'myController'], new RequestMatcher());

        $this->assertSame('myController', $route->getController());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getAction
     */
    public function testGetAction()
    {
        $route = new Route('name', '/path/of/route', [], 'view', ['action' => 'myAction'], new RequestMatcher());

        $this->assertSame('myAction', $route->getAction());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getController
     * @covers PitchBlade\Router\Route::getAction
     */
    public function testGetControllerAndGetAction()
    {
        $route = new Route(
            'name',
            '/path/of/route',
            [],
            'view',
            ['name' => 'myController', 'action' => 'myAction'],
            new RequestMatcher()
        );

        $this->assertSame('myController', $route->getController());
        $this->assertSame('myAction', $route->getAction());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getDependencies
     */
    public function testGetDependenciesWithoutDependencies()
    {
        $route = new Route('name', '/path/of/route', [], 'view', [], new RequestMatcher());

        $this->assertSame([], $route->getDependencies());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getDependencies
     */
    public function testGetDependenciesWithEmptyDependencies()
    {
        $route = new Route('name', '/path/of/route', [], 'view', ['dependencies' => []], new RequestMatcher());

        $this->assertSame([], $route->getDependencies());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getDependencies
     */
    public function testGetDependenciesFilled()
    {
        $route = new Route(
            'name',
            '/path/of/route',
            [],
            'view',
            ['dependencies' => ['some dependency', 'another dependency']],
            new RequestMatcher()
        );

        $this->assertSame(['some dependency', 'another dependency'], $route->getDependencies());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getView
     */
    public function testGetView()
    {
        $route = new Route(
            'name',
            '/path/of/route',
            [],
            'view',
            ['dependencies' => ['some dependency', 'another dependency']],
            new RequestMatcher()
        );

        $this->assertSame('view', $route->getView());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getDefaults
     */
    public function testGetDefaultsWithoutDefaults()
    {
        $route = new Route(
            'name',
            '/path/of/route',
            [],
            'view',
            ['dependencies' => ['some dependency', 'another dependency']],
            new RequestMatcher()
        );

        $this->assertSame([], $route->getDefaults());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getDefaults
     */
    public function testGetDefaultsWithEmptyDefaults()
    {
        $route = new Route(
            'name',
            '/path/of/route',
            [],
            'view',
            ['dependencies' => ['some dependency', 'another dependency']],
            new RequestMatcher(),
            []
        );

        $this->assertSame([], $route->getDefaults());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getDefaults
     */
    public function testGetDefaultsFilled()
    {
        $route = new Route(
            'name',
            '/path/of/route',
            [],
            'view',
            ['dependencies' => ['some dependency', 'another dependency']],
            new RequestMatcher(),
            ['somemapping' => 'somevalue']
        );

        $this->assertSame(['somemapping' => 'somevalue'], $route->getDefaults());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getPathVariables
     */
    public function testGetPathVariablesWithoutVariables()
    {
        $route = new Route(
            'name',
            '/path/of/route',
            [],
            'view',
            ['dependencies' => ['some dependency', 'another dependency']],
            new RequestMatcher(),
            ['somemapping' => 'somevalue']
        );

        $this->assertSame([], $route->getPathVariables());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getPathVariables
     */
    public function testGetPathVariablesWithTwoInvalidVariables()
    {
        $route = new Route(
            'name',
            '/pa:th/of/ro:ute',
            [],
            'view',
            ['dependencies' => ['some dependency', 'another dependency']],
            new RequestMatcher(),
            ['somemapping' => 'somevalue']
        );

        $this->assertSame([], $route->getPathVariables());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getPathVariables
     */
    public function testGetPathVariablesWithTwoValidVariables()
    {
        $route = new Route(
            'name',
            '/:path/of/:route',
            [],
            'view',
            ['dependencies' => ['some dependency', 'another dependency']],
            new RequestMatcher(),
            ['somemapping' => 'somevalue']
        );

        $this->assertSame(['path', 'route'], $route->getPathVariables());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getPathVariables
     */
    public function testGetPathVariablesWithInvalidAndValidVariablesValidFirst()
    {
        $route = new Route(
            'name',
            '/:path/of/ro:ute',
            [],
            'view',
            ['dependencies' => ['some dependency', 'another dependency']],
            new RequestMatcher(),
            ['somemapping' => 'somevalue']
        );

        $this->assertSame(['path'], $route->getPathVariables());
    }

    /**
     * @covers PitchBlade\Router\Route::__construct
     * @covers PitchBlade\Router\Route::getPathVariables
     */
    public function testGetPathVariablesWithInvalidAndValidVariablesValidLast()
    {
        $route = new Route(
            'name',
            '/pa:th/of/:route',
            [],
            'view',
            ['dependencies' => ['some dependency', 'another dependency']],
            new RequestMatcher(),
            ['somemapping' => 'somevalue']
        );

        $this->assertSame(['route'], $route->getPathVariables());
    }
}
