<?php

namespace PitchBlade\Router\RequestMatcher;

use PitchBlade\Router\RequestMatcher\Factory,
    PitchBladeTest\Mocks\Http\Request,
    PitchBladeTest\Mocks\Acl\Verifier;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\RequestMatcher\Factory::__construct
     */
    public function testConstructCorrectInterface()
    {
        $factory = new Factory(new Request([]), new Verifier([]));

        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatcher\\Builder', $factory);
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Factory::__construct
     * @covers PitchBlade\Router\RequestMatcher\Factory::build
     */
    public function testBuildUnknownClassStandard()
    {
        $factory = new Factory(new Request([]), new Verifier([]));

        $this->setExpectedException('\\PitchBlade\\Router\\RequestMatcher\\UnknownMatcherException');

        $factory->build('UnknownClass');
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Factory::__construct
     * @covers PitchBlade\Router\RequestMatcher\Factory::build
     */
    public function testBuildUnknownClassCustom()
    {
        $factory = new Factory(new Request([]), new Verifier([]));

        $this->setExpectedException('\\PitchBlade\\Router\\RequestMatcher\\UnknownMatcherException');

        $factory->build('\\PitchBladeTest\\Mocks\\Router\\RequestMatcher\\UnknownClass');
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Factory::__construct
     * @covers PitchBlade\Router\RequestMatcher\Factory::build
     */
    public function testBuildStandardClassLowercase()
    {
        $factory = new Factory(new Request([]), new Verifier([]));

        $matcher = $factory->build('ssl');

        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatcher\\Matchable', $matcher);
        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatcher\\Ssl', $matcher);
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Factory::__construct
     * @covers PitchBlade\Router\RequestMatcher\Factory::build
     */
    public function testBuildStandardClassUppercase()
    {
        $factory = new Factory(new Request([]), new Verifier([]));

        $matcher = $factory->build('SSL');

        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatcher\\Matchable', $matcher);
        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatcher\\Ssl', $matcher);
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Factory::__construct
     * @covers PitchBlade\Router\RequestMatcher\Factory::build
     */
    public function testBuildStandardClassReversedcase()
    {
        $factory = new Factory(new Request([]), new Verifier([]));

        $matcher = $factory->build('sSL');

        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatcher\\Matchable', $matcher);
        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatcher\\Ssl', $matcher);
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Factory::__construct
     * @covers PitchBlade\Router\RequestMatcher\Factory::build
     */
    public function testBuildStandardClassCorrectcase()
    {
        $factory = new Factory(new Request([]), new Verifier([]));

        $matcher = $factory->build('Ssl');

        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatcher\\Matchable', $matcher);
        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatcher\\Ssl', $matcher);
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Factory::__construct
     * @covers PitchBlade\Router\RequestMatcher\Factory::build
     */
    public function testBuildCustomCorrect()
    {
        $factory = new Factory(new Request([]), new Verifier([]));

        $matcher = $factory->build('\\PitchBladeTest\\Mocks\\Router\\RequestMatcher\\Custom');

        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatcher\\Matchable', $matcher);
        $this->assertInstanceOf('\\PitchBladeTest\\Mocks\\Router\\RequestMatcher\\Custom', $matcher);
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Factory::__construct
     * @covers PitchBlade\Router\RequestMatcher\Factory::build
     */
    public function testBuildPermissions()
    {
        $factory = new Factory(new Request([]), new Verifier([]));

        $matcher = $factory->build('permissions');

        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatcher\\Matchable', $matcher);
        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatcher\\Permissions', $matcher);
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Factory::__construct
     * @covers PitchBlade\Router\RequestMatcher\Factory::build
     */
    public function testBuildCustomWrongInterface()
    {
        $factory = new Factory(new Request([]), new Verifier([]));

        $this->setExpectedException('\\PitchBlade\\Router\\RequestMatcher\\InvalidMatcherException');

        $matcher = $factory->build('\\PitchBladeTest\\Mocks\\Router\\RequestMatcher\\FalseMatcher');
    }
}
