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

    /**
     * @covers PitchBlade\Router\Route\Route::__construct
     * @covers PitchBlade\Router\Route\Route::matchesRequest
     * @covers PitchBlade\Router\Route\Route::doesMatch
     */
    public function testMatchesRequestNoMatchNotEnoughUriPathSegments()
    {
        $path = $this->getMock('\\PitchBlade\\Router\\Path\\Parser');
        $path->expects($this->once())
            ->method('getParts')
            ->will($this->returnValue([]));

        $route = new Route('name', $path, function () {});

        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('getPath')
            ->will($this->returnValue('/foo/bar'));

        $this->assertFalse($route->matchesRequest($request));
    }

    /**
     * @covers PitchBlade\Router\Route\Route::__construct
     * @covers PitchBlade\Router\Route\Route::matchesRequest
     * @covers PitchBlade\Router\Route\Route::doesMatch
     * @covers PitchBlade\Router\Route\Route::doesStaticSegmentMatch
     * @covers PitchBlade\Router\Route\Route::processVariables
     */
    public function testMatchesRequestWithMatchingStaticSegment()
    {
        $segment = $this->getMock('\\PitchBlade\\Router\\Path\\Segment');
        $segment->expects($this->any())
            ->method('isVariable')
            ->will($this->returnValue(false));
        $segment->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue('foo'));

        $path = $this->getMock('\\PitchBlade\\Router\\Path\\Parser');
        $path->expects($this->any())
            ->method('getParts')
            ->will($this->returnValue([$segment]));

        $route = new Route('name', $path, function () {});

        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('getPath')
            ->will($this->returnValue('/foo'));

        $this->assertTrue($route->matchesRequest($request));
    }

    /**
     * @covers PitchBlade\Router\Route\Route::__construct
     * @covers PitchBlade\Router\Route\Route::matchesRequest
     * @covers PitchBlade\Router\Route\Route::doesMatch
     * @covers PitchBlade\Router\Route\Route::doesStaticSegmentMatch
     */
    public function testMatchesRequestWithNonMatchingStaticSegment()
    {
        $segment = $this->getMock('\\PitchBlade\\Router\\Path\\Segment');
        $segment->expects($this->once())
            ->method('isVariable')
            ->will($this->returnValue(false));
        $segment->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue('foo'));

        $path = $this->getMock('\\PitchBlade\\Router\\Path\\Parser');
        $path->expects($this->once())
            ->method('getParts')
            ->will($this->returnValue([$segment]));

        $route = new Route('name', $path, function () {});

        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('getPath')
            ->will($this->returnValue('/bar'));

        $this->assertFalse($route->matchesRequest($request));
    }

    /**
     * @covers PitchBlade\Router\Route\Route::__construct
     * @covers PitchBlade\Router\Route\Route::matchesRequest
     * @covers PitchBlade\Router\Route\Route::doesMatch
     * @covers PitchBlade\Router\Route\Route::isRequiredSegmentSet
     * @covers PitchBlade\Router\Route\Route::areRequirementsMet
     * @covers PitchBlade\Router\Route\Route::processVariables
     * @covers PitchBlade\Router\Route\Route::processVariable
     */
    public function testMatchesRequestWithMatchingAndFilledInRequiredSegment()
    {
        $segment = $this->getMock('\\PitchBlade\\Router\\Path\\Segment');
        $segment->expects($this->once())
            ->method('isOptional')
            ->will($this->returnValue(false));
        $segment->expects($this->any())
            ->method('isVariable')
            ->will($this->returnValue(true));

        $path = $this->getMock('\\PitchBlade\\Router\\Path\\Parser');
        $path->expects($this->any())
            ->method('getParts')
            ->will($this->returnValue([$segment]));

        $route = new Route('name', $path, function () {});

        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('getPath')
            ->will($this->returnValue('/foo'));

        $this->assertTrue($route->matchesRequest($request));
    }

    /**
     * @covers PitchBlade\Router\Route\Route::__construct
     * @covers PitchBlade\Router\Route\Route::matchesRequest
     * @covers PitchBlade\Router\Route\Route::doesMatch
     * @covers PitchBlade\Router\Route\Route::isRequiredSegmentSet
     * @covers PitchBlade\Router\Route\Route::areRequirementsMet
     * @covers PitchBlade\Router\Route\Route::processVariables
     * @covers PitchBlade\Router\Route\Route::processVariable
     */
    public function testMatchesRequestWithMatchingAndDefaultRequiredSegment()
    {
        $segment = $this->getMock('\\PitchBlade\\Router\\Path\\Segment');
        $segment->expects($this->once())
            ->method('isOptional')
            ->will($this->returnValue(false));
        $segment->expects($this->any())
            ->method('isVariable')
            ->will($this->returnValue(true));
        $segment->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue('foo'));

        $path = $this->getMock('\\PitchBlade\\Router\\Path\\Parser');
        $path->expects($this->any())
            ->method('getParts')
            ->will($this->returnValue([$segment]));

        $route = new Route('name', $path, function () {});
        $route->defaults(['foo' => 'bar']);

        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('getPath')
            ->will($this->returnValue('/'));

        $this->assertTrue($route->matchesRequest($request));
    }

    /**
     * @covers PitchBlade\Router\Route\Route::__construct
     * @covers PitchBlade\Router\Route\Route::matchesRequest
     * @covers PitchBlade\Router\Route\Route::doesMatch
     * @covers PitchBlade\Router\Route\Route::isRequiredSegmentSet
     */
    public function testMatchesRequestWithNonMatchingRequiredSegment()
    {
        $segment = $this->getMock('\\PitchBlade\\Router\\Path\\Segment');
        $segment->expects($this->once())
            ->method('isOptional')
            ->will($this->returnValue(false));
        $segment->expects($this->any())
            ->method('isVariable')
            ->will($this->returnValue(true));
        $segment->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue('foo'));

        $path = $this->getMock('\\PitchBlade\\Router\\Path\\Parser');
        $path->expects($this->any())
            ->method('getParts')
            ->will($this->returnValue([$segment]));

        $route = new Route('name', $path, function () {});

        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('getPath')
            ->will($this->returnValue('/'));

        $this->assertFalse($route->matchesRequest($request));
    }

    /**
     * @covers PitchBlade\Router\Route\Route::__construct
     * @covers PitchBlade\Router\Route\Route::wherePattern
     * @covers PitchBlade\Router\Route\Route::matchesRequest
     * @covers PitchBlade\Router\Route\Route::doesMatch
     * @covers PitchBlade\Router\Route\Route::isRequiredSegmentSet
     * @covers PitchBlade\Router\Route\Route::areRequirementsMet
     * @covers PitchBlade\Router\Route\Route::processVariables
     * @covers PitchBlade\Router\Route\Route::processVariable
     */
    public function testMatchesRequestWithMatchingRequirement()
    {
        $segment = $this->getMock('\\PitchBlade\\Router\\Path\\Segment');
        $segment->expects($this->once())
            ->method('isOptional')
            ->will($this->returnValue(false));
        $segment->expects($this->any())
            ->method('isVariable')
            ->will($this->returnValue(true));
        $segment->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue('foo'));

        $path = $this->getMock('\\PitchBlade\\Router\\Path\\Parser');
        $path->expects($this->any())
            ->method('getParts')
            ->will($this->returnValue([$segment]));

        $route = new Route('name', $path, function () {});
        $route->wherePattern(['foo' => 'bar']);

        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('getPath')
            ->will($this->returnValue('/bar'));

        $this->assertTrue($route->matchesRequest($request));
    }

    /**
     * @covers PitchBlade\Router\Route\Route::__construct
     * @covers PitchBlade\Router\Route\Route::wherePattern
     * @covers PitchBlade\Router\Route\Route::matchesRequest
     * @covers PitchBlade\Router\Route\Route::doesMatch
     * @covers PitchBlade\Router\Route\Route::isRequiredSegmentSet
     * @covers PitchBlade\Router\Route\Route::areRequirementsMet
     */
    public function testMatchesRequestWithNonMatchingRequirement()
    {
        $segment = $this->getMock('\\PitchBlade\\Router\\Path\\Segment');
        $segment->expects($this->once())
            ->method('isOptional')
            ->will($this->returnValue(false));
        $segment->expects($this->any())
            ->method('isVariable')
            ->will($this->returnValue(true));
        $segment->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue('foo'));

        $path = $this->getMock('\\PitchBlade\\Router\\Path\\Parser');
        $path->expects($this->any())
            ->method('getParts')
            ->will($this->returnValue([$segment]));

        $route = new Route('name', $path, function () {});
        $route->wherePattern(['foo' => 'baz']);

        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('getPath')
            ->will($this->returnValue('/bar'));

        $this->assertFalse($route->matchesRequest($request));
    }
}
