<?php

namespace PitchBladeTest\Unit\Router;

use PitchBlade\Router\RequestMatcher;

class RequestMatcherTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\RequestMatcher::__construct
     */
    public function testConstructCorrectInstance()
    {
        $matcher = new RequestMatcher($this->getMock('\\PitchBlade\\Router\\RequestMatcher\\Builder'));

        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatchable', $matcher);
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher::__construct
     * @covers PitchBlade\Router\RequestMatcher::doesMatch
     */
    public function xtestDoesMatchTrue()
    {
        $factory = $this->getMock('\\PitchBlade\\Router\\RequestMatcher\\Builder');
        $factory->expects($this->once())
            ->method('build')
            ->will($this->returnCallback(function() {
                $trueMatcher = $this->getMock('\\PitchBlade\\Router\\RequestMatcher\\Matchable');
                $trueMatcher->expects($this->once())
                    ->method('doesMatch')
                    ->will($this->returnValue(true));

                return $trueMatcher;
            }));

        $matcher = new RequestMatcher($factory);

        $requirements = [
            'TrueMatcher' => 1
        ];

        $this->assertTrue($matcher->doesMatch($requirements));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher::__construct
     * @covers PitchBlade\Router\RequestMatcher::doesMatch
     */
    public function testDoesMatchTrueMultiple()
    {
        $factory = $this->getMock('\\PitchBlade\\Router\\RequestMatcher\\Builder');
        $factory->expects($this->at(0))
            ->method('build')
            ->will($this->returnCallback(function() {
                $trueMatcher = $this->getMock('\\PitchBlade\\Router\\RequestMatcher\\Matchable');
                $trueMatcher->expects($this->once())
                    ->method('doesMatch')
                    ->will($this->returnValue(true));

                return $trueMatcher;
            }));
        $factory->expects($this->at(1))
            ->method('build')
            ->will($this->returnCallback(function() {
                $trueMatcher = $this->getMock('\\PitchBlade\\Router\\RequestMatcher\\Matchable');
                $trueMatcher->expects($this->once())
                    ->method('doesMatch')
                    ->will($this->returnValue(true));

                return $trueMatcher;
            }));

        $matcher = new RequestMatcher($factory);

        $requirements = [
            'TrueMatcher' => 1,
            'TrueMatcher2' => 1,
        ];

        $this->assertTrue($matcher->doesMatch($requirements));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher::__construct
     * @covers PitchBlade\Router\RequestMatcher::doesMatch
     */
    public function testDoesMatchFalse()
    {
        $factory = $this->getMock('\\PitchBlade\\Router\\RequestMatcher\\Builder');
        $factory->expects($this->once())
            ->method('build')
            ->will($this->returnCallback(function() {
                $falseMatcher = $this->getMock('\\PitchBlade\\Router\\RequestMatcher\\Matchable');
                $falseMatcher->expects($this->once())
                    ->method('doesMatch')
                    ->will($this->returnValue(false));

                return $falseMatcher;
            }));

        $matcher = new RequestMatcher($factory);

        $requirements = [
            'FalseMatcher' => 1,
        ];

        $this->assertFalse($matcher->doesMatch($requirements));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher::__construct
     * @covers PitchBlade\Router\RequestMatcher::doesMatch
     */
    public function testDoesMatchFalseFirstMultiple()
    {
        $factory = $this->getMock('\\PitchBlade\\Router\\RequestMatcher\\Builder');
        $factory->expects($this->at(0))
            ->method('build')
            ->will($this->returnCallback(function() {
                $falseMatcher = $this->getMock('\\PitchBlade\\Router\\RequestMatcher\\Matchable');
                $falseMatcher->expects($this->once())
                    ->method('doesMatch')
                    ->will($this->returnValue(false));

                return $falseMatcher;
            }));

        $matcher = new RequestMatcher($factory);

        $requirements = [
            'FalseMatcher' => 1,
            'TrueMatcher' => 1,
        ];

        $this->assertFalse($matcher->doesMatch($requirements));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher::__construct
     * @covers PitchBlade\Router\RequestMatcher::doesMatch
     */
    public function testDoesMatchFalseLastMultiple()
    {
        $factory = $this->getMock('\\PitchBlade\\Router\\RequestMatcher\\Builder');
        $factory->expects($this->at(0))
            ->method('build')
            ->will($this->returnCallback(function() {
                $trueMatcher = $this->getMock('\\PitchBlade\\Router\\RequestMatcher\\Matchable');
                $trueMatcher->expects($this->once())
                    ->method('doesMatch')
                    ->will($this->returnValue(true));

                return $trueMatcher;
            }));
        $factory->expects($this->at(1))
            ->method('build')
            ->will($this->returnCallback(function() {
                $falseMatcher = $this->getMock('\\PitchBlade\\Router\\RequestMatcher\\Matchable');
                $falseMatcher->expects($this->once())
                    ->method('doesMatch')
                    ->will($this->returnValue(false));

                return $falseMatcher;
            }));

        $matcher = new RequestMatcher($factory);

        $requirements = [
            'TrueMatcher' => 1,
            'FalseMatcher' => 1,
        ];

        $this->assertFalse($matcher->doesMatch($requirements));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher::__construct
     * @covers PitchBlade\Router\RequestMatcher::doesMatch
     */
    public function testDoesMatchFalseBothMultiple()
    {
        $factory = $this->getMock('\\PitchBlade\\Router\\RequestMatcher\\Builder');
        $factory->expects($this->at(0))
            ->method('build')
            ->will($this->returnCallback(function() {
                $falseMatcher = $this->getMock('\\PitchBlade\\Router\\RequestMatcher\\Matchable');
                $falseMatcher->expects($this->once())
                    ->method('doesMatch')
                    ->will($this->returnValue(false));

                return $falseMatcher;
            }));

        $matcher = new RequestMatcher($factory);

        $requirements = [
            'FalseMatcher' => 1,
            'FalseMatcher2' => 1,
        ];

        $this->assertFalse($matcher->doesMatch($requirements));
    }
}
