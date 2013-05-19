<?php

namespace PitchBladeTest\Unit\Router\RequestMatcher;

use PitchBlade\Router\RequestMatcher\Host,
    PitchBladeTest\Mocks\Http\Request;

class HostTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\RequestMatcher\Host::__construct
     */
    public function testConstructCorrentInterface()
    {
        $matcher = new Host(new Request([]));

        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatcher\\Matchable', $matcher);
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Host::__construct
     * @covers PitchBlade\Router\RequestMatcher\Host::doesMatch
     */
    public function testDoesMatchTrue()
    {
        $matcher = new Host(new Request(['host' => 'pitchblade.com']));

        $this->assertTrue($matcher->doesMatch('/^pitchblade\.com$/'));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Host::__construct
     * @covers PitchBlade\Router\RequestMatcher\Host::doesMatch
     */
    public function testDoesMatchFalse()
    {
        $matcher = new Host(new Request(['host' => 'pitchblade.comx']));

        $this->assertFalse($matcher->doesMatch('/^pitchblade\.com$/'));
    }
}
