<?php

namespace PitchBladeTest\Unit\Router\RequestMatcher;

use PitchBlade\Router\RequestMatcher\Path,
    PitchBladeTest\Mocks\Http\Request;

class PathTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\RequestMatcher\Path::__construct
     */
    public function testConstructCorrentInterface()
    {
        $matcher = new Path(new Request([]));

        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatcher\\Matchable', $matcher);
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Path::__construct
     * @covers PitchBlade\Router\RequestMatcher\Path::doesMatch
     */
    public function testDoesMatchTrue()
    {
        $matcher = new Path(new Request(['path' => '/path/to/resource']));

        $this->assertTrue($matcher->doesMatch('/^\/path\/to\/resource$/'));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Path::__construct
     * @covers PitchBlade\Router\RequestMatcher\Path::doesMatch
     */
    public function testDoesMatchFalse()
    {
        $matcher = new Path(new Request(['path' => '/path/to/resource']));

        $this->assertFalse($matcher->doesMatch('/^\/path\/to\/resourcex$/'));
    }
}
