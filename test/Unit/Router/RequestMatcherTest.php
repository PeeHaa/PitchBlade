<?php

namespace PitchBladeTest\Unit\Router;

use PitchBlade\Router\RequestMatcher,
    PitchBladeTest\Mocks\Router\RequestMatcher\Factory;

class RequestMatcherTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\RequestMatcher::__construct
     */
    public function testConstructCorrectInstance()
    {
        $matcher = new RequestMatcher(new Factory());

        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatchable', $matcher);
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher::__construct
     * @covers PitchBlade\Router\RequestMatcher::doesMatch
     */
    public function testDoesMatchTrue()
    {
        $matcher = new RequestMatcher(new Factory());

        $requirements = [
            '\\PitchBladeTest\\Mocks\\Router\\RequestMatcher\\TrueMatcher' => 1
        ];

        $this->assertTrue($matcher->doesMatch($requirements));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher::__construct
     * @covers PitchBlade\Router\RequestMatcher::doesMatch
     */
    public function testDoesMatchTrueMultiple()
    {
        $matcher = new RequestMatcher(new Factory());

        $requirements = [
            '\\PitchBladeTest\\Mocks\\Router\\RequestMatcher\\TrueMatcher' => 1,
            '\\PitchBladeTest\\Mocks\\Router\\RequestMatcher\\TrueMatcher' => 1
        ];

        $this->assertTrue($matcher->doesMatch($requirements));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher::__construct
     * @covers PitchBlade\Router\RequestMatcher::doesMatch
     */
    public function testDoesMatchFalse()
    {
        $matcher = new RequestMatcher(new Factory());

        $requirements = [
            '\\PitchBladeTest\\Mocks\\Router\\RequestMatcher\\FalseMatcher' => 1
        ];

        $this->assertFalse($matcher->doesMatch($requirements));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher::__construct
     * @covers PitchBlade\Router\RequestMatcher::doesMatch
     */
    public function testDoesMatchFalseFirstMultiple()
    {
        $matcher = new RequestMatcher(new Factory());

        $requirements = [
            '\\PitchBladeTest\\Mocks\\Router\\RequestMatcher\\FalseMatcher' => 1,
            '\\PitchBladeTest\\Mocks\\Router\\RequestMatcher\\TrueMatcher' => 1
        ];

        $this->assertFalse($matcher->doesMatch($requirements));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher::__construct
     * @covers PitchBlade\Router\RequestMatcher::doesMatch
     */
    public function testDoesMatchFalseLastMultiple()
    {
        $matcher = new RequestMatcher(new Factory());

        $requirements = [
            '\\PitchBladeTest\\Mocks\\Router\\RequestMatcher\\TrueMatcher' => 1,
            '\\PitchBladeTest\\Mocks\\Router\\RequestMatcher\\FalseMatcher' => 1
        ];

        $this->assertFalse($matcher->doesMatch($requirements));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher::__construct
     * @covers PitchBlade\Router\RequestMatcher::doesMatch
     */
    public function testDoesMatchFalseBothMultiple()
    {
        $matcher = new RequestMatcher(new Factory());

        $requirements = [
            '\\PitchBladeTest\\Mocks\\Router\\RequestMatcher\\FalseMatcher' => 1,
            '\\PitchBladeTest\\Mocks\\Router\\RequestMatcher\\FalseMatcher' => 1
        ];

        $this->assertFalse($matcher->doesMatch($requirements));
    }
}
