<?php

namespace PitchBladeTest\Unit\Router\RequestMatcher;

use PitchBlade\Router\RequestMatcher\Method,
    PitchBladeTest\Mocks\Http\Request;

class MethodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\RequestMatcher\Method::__construct
     */
    public function testConstructCorrentInterface()
    {
        $matcher = new Method(new Request([]));

        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatcher\\Matchable', $matcher);
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Method::__construct
     * @covers PitchBlade\Router\RequestMatcher\Method::doesMatch
     */
    public function testDoesMatchTrue()
    {
        $matcher = new Method(new Request(['method' => 'POST']));

        $this->assertTrue($matcher->doesMatch('POST'));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Method::__construct
     * @covers PitchBlade\Router\RequestMatcher\Method::doesMatch
     */
    public function testDoesMatchTrueDifferentCasing()
    {
        $matcher = new Method(new Request(['method' => 'POST']));

        $this->assertTrue($matcher->doesMatch('post'));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Method::__construct
     * @covers PitchBlade\Router\RequestMatcher\Method::doesMatch
     */
    public function testDoesMatchFalse()
    {
        $matcher = new Method(new Request(['method' => 'POST']));

        $this->assertFalse($matcher->doesMatch('GET'));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Method::__construct
     * @covers PitchBlade\Router\RequestMatcher\Method::doesMatch
     */
    public function testDoesMatchFalseDifferentCasing()
    {
        $matcher = new Method(new Request(['method' => 'POST']));

        $this->assertFalse($matcher->doesMatch('get'));
    }
}
