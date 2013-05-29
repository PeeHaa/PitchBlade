<?php

namespace PitchBladeTest\Unit\Router;

use PitchBlade\Router\RouteFactory,
    PitchBladeTest\Mocks\Router\RequestMatcher,
    PitchBlade\Router\Route;

class RouteFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\RouteFactory::__construct
     */
    public function testConstructCorrectInstance()
    {
        $factory = new RouteFactory(new RequestMatcher());

        $this->assertInstanceOf('\\PitchBlade\\Router\\RouteBuilder', $factory);
    }

    /**
     * @covers PitchBlade\Router\RouteFactory::__construct
     * @covers PitchBlade\Router\RouteFactory::build
     */
    public function testBuildWithoutDefaults()
    {
        $factory = new RouteFactory(new RequestMatcher());

        $this->assertInstanceOf(
            '\\PitchBlade\\Router\\Route',
            $factory->build('test', '/path/of/route', [], 'view', ['controller', 'action'])
        );
    }

    /**
     * @covers PitchBlade\Router\RouteFactory::__construct
     * @covers PitchBlade\Router\RouteFactory::build
     */
    public function testBuildWithDefaults()
    {
        $factory = new RouteFactory(new RequestMatcher());

        $this->assertInstanceOf(
            '\\PitchBlade\\Router\\Route',
            $factory->build('test', '/path/of/route', [], 'view', ['controller', 'action'], [])
        );
    }
}
