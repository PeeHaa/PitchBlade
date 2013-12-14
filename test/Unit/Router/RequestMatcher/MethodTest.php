<?php

namespace PitchBladeTest\Unit\Router\RequestMatcher;

use PitchBlade\Router\RequestMatcher\Method;

class MethodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\RequestMatcher\Method::__construct
     */
    public function testConstructCorrentInterface()
    {
        $matcher = new Method($this->getMock('\\PitchBlade\\Network\\Http\\RequestData'));

        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatcher\\Matchable', $matcher);
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Method::__construct
     * @covers PitchBlade\Router\RequestMatcher\Method::doesMatch
     */
    public function testDoesMatchTrue()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('getMethod')
            ->will($this->returnValue('POST'));

        $matcher = new Method($request);

        $this->assertTrue($matcher->doesMatch('POST'));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Method::__construct
     * @covers PitchBlade\Router\RequestMatcher\Method::doesMatch
     */
    public function testDoesMatchTrueDifferentCasing()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('getMethod')
            ->will($this->returnValue('POST'));

        $matcher = new Method($request);

        $this->assertTrue($matcher->doesMatch('post'));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Method::__construct
     * @covers PitchBlade\Router\RequestMatcher\Method::doesMatch
     */
    public function testDoesMatchFalse()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('getMethod')
            ->will($this->returnValue('POST'));

        $matcher = new Method($request);

        $this->assertFalse($matcher->doesMatch('GET'));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Method::__construct
     * @covers PitchBlade\Router\RequestMatcher\Method::doesMatch
     */
    public function testDoesMatchFalseDifferentCasing()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('getMethod')
            ->will($this->returnValue('POST'));

        $matcher = new Method($request);

        $this->assertFalse($matcher->doesMatch('get'));
    }
}
