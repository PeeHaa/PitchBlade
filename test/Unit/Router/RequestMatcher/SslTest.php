<?php

namespace PitchBladeTest\Unit\Router\RequestMatcher;

use PitchBlade\Router\RequestMatcher\Ssl;

class SslTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\RequestMatcher\Ssl::__construct
     */
    public function testConstructCorrentInterface()
    {
        $matcher = new Ssl($this->getMock('\\PitchBlade\\Network\\Http\\RequestData'));

        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatcher\\Matchable', $matcher);
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Ssl::__construct
     * @covers PitchBlade\Router\RequestMatcher\Ssl::doesMatch
     */
    public function testDoesMatchTrue()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('isSecure')
            ->will($this->returnValue(true));

        $matcher = new Ssl($request);

        $this->assertTrue($matcher->doesMatch(true));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Ssl::__construct
     * @covers PitchBlade\Router\RequestMatcher\Ssl::doesMatch
     */
    public function testDoesMatchFalse()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('isSecure')
            ->will($this->returnValue(false));

        $matcher = new Ssl($request);

        $this->assertFalse($matcher->doesMatch(true));
    }
}
