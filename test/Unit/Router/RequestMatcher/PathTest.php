<?php

namespace PitchBladeTest\Unit\Router\RequestMatcher;

use PitchBlade\Router\RequestMatcher\Path;

class PathTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\RequestMatcher\Path::__construct
     */
    public function testConstructCorrentInterface()
    {
        $matcher = new Path($this->getMock('\\PitchBlade\\Network\\Http\\RequestData'));

        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatcher\\Matchable', $matcher);
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Path::__construct
     * @covers PitchBlade\Router\RequestMatcher\Path::doesMatch
     */
    public function testDoesMatchTrue()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('getPath')
            ->will($this->returnValue('/path/to/resource'));

        $matcher = new Path($request);

        $this->assertTrue($matcher->doesMatch('/^\/path\/to\/resource$/'));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Path::__construct
     * @covers PitchBlade\Router\RequestMatcher\Path::doesMatch
     */
    public function testDoesMatchFalse()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('getPath')
            ->will($this->returnValue('/path/to/resource'));

        $matcher = new Path($request);

        $this->assertFalse($matcher->doesMatch('/^\/path\/to\/resourcex$/'));
    }
}
