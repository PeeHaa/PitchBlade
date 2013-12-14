<?php

namespace PitchBladeTest\Unit\Router\RequestMatcher;

use PitchBlade\Router\RequestMatcher\Host;

class HostTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\RequestMatcher\Host::__construct
     */
    public function testConstructCorrentInterface()
    {
        $matcher = new Host($this->getMock('\\PitchBlade\\Network\\Http\\RequestData'));

        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatcher\\Matchable', $matcher);
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Host::__construct
     * @covers PitchBlade\Router\RequestMatcher\Host::doesMatch
     */
    public function testDoesMatchTrue()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('server')
            ->will($this->returnValue('pitchblade.com'));

        $matcher = new Host($request);

        $this->assertTrue($matcher->doesMatch('/^pitchblade\.com$/'));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Host::__construct
     * @covers PitchBlade\Router\RequestMatcher\Host::doesMatch
     */
    public function testDoesMatchFalse()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('server')
            ->will($this->returnValue('pitchblade.comx'));

        $matcher = new Host($request);

        $this->assertFalse($matcher->doesMatch('/^pitchblade\.com$/'));
    }
}
