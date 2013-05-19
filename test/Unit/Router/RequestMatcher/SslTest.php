<?php

namespace PitchBladeTest\Unit\Router\RequestMatcher;

use PitchBlade\Router\RequestMatcher\Ssl,
    PitchBladeTest\Mocks\Http\Request;

class SslTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\RequestMatcher\Ssl::__construct
     */
    public function testConstructCorrentInterface()
    {
        $matcher = new Ssl(new Request([]));

        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatcher\\Matchable', $matcher);
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Ssl::__construct
     * @covers PitchBlade\Router\RequestMatcher\Ssl::doesMatch
     */
    public function testDoesMatchTrue()
    {
        $matcher = new Ssl(new Request(['ssl' => true]));

        $this->assertTrue($matcher->doesMatch(true));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Ssl::__construct
     * @covers PitchBlade\Router\RequestMatcher\Ssl::doesMatch
     */
    public function testDoesMatchFalse()
    {
        $matcher = new Ssl(new Request(['ssl' => false]));

        $this->assertFalse($matcher->doesMatch(true));
    }
}
