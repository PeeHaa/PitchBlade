<?php

namespace PitchBladeTest\Unit\Router;

use PitchBlade\Router\UrlBuilder,
    PitchBladeTest\Mocks\Router\Routes,
    PitchBladeTest\Mocks\Router\RoutesFaker;

class UrlBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\UrlBuilder::__construct
     */
    public function testConstructCorrectInterface()
    {
        $urlBuilder = new UrlBuilder(new Routes());

        $this->assertInstanceOf('\\PitchBlade\\Router\\UrlBuildable', $urlBuilder);
    }

    /**
     * @covers PitchBlade\Router\UrlBuilder::__construct
     * @covers PitchBlade\Router\UrlBuilder::build
     */
    public function testBuildWithoutDefaultsOrParams()
    {
        $urlBuilder = new UrlBuilder(new RoutesFaker([
            'path' => '/test/path',
            'defaults' => []
        ]));

        $this->assertSame('/test/path', $urlBuilder->build('test'));
    }

    /**
     * @covers PitchBlade\Router\UrlBuilder::__construct
     * @covers PitchBlade\Router\UrlBuilder::build
     */
    public function testBuildThrowsExceptionOnMissingParam()
    {
        $urlBuilder = new UrlBuilder(new RoutesFaker([
            'path' => '/:test/path',
            'defaults' => []
        ]));

        $this->setExpectedException('\\PitchBlade\\Router\\MissingUrlParameterException');

        $urlBuilder->build('test');
    }

    /**
     * @covers PitchBlade\Router\UrlBuilder::__construct
     * @covers PitchBlade\Router\UrlBuilder::fillPath
     * @covers PitchBlade\Router\UrlBuilder::build
     */
    public function testBuildWithSingleDefault()
    {
        $urlBuilder = new UrlBuilder(new RoutesFaker([
            'path' => '/:test/path',
            'defaults' => ['test' => 'value'],
            'pathVariables' => [0 => 'test']
        ]));

        $this->assertSame('/value/path', $urlBuilder->build('test'));
    }

    /**
     * @covers PitchBlade\Router\UrlBuilder::__construct
     * @covers PitchBlade\Router\UrlBuilder::fillPath
     * @covers PitchBlade\Router\UrlBuilder::build
     */
    public function testBuildWithSingleDefaultNotInPathVariables()
    {
        $urlBuilder = new UrlBuilder(new RoutesFaker([
            'path' => '/:test/path',
            'defaults' => ['test' => 'value'],
            'pathVariables' => []
        ]));

        $this->setExpectedException('\\PitchBlade\\Router\\MissingUrlParameterException');

        $urlBuilder->build('test');
    }

    /**
     * @covers PitchBlade\Router\UrlBuilder::__construct
     * @covers PitchBlade\Router\UrlBuilder::fillPath
     * @covers PitchBlade\Router\UrlBuilder::build
     */
    public function testBuildWithSingleDefaultNotInPath()
    {
        $urlBuilder = new UrlBuilder(new RoutesFaker([
            'path' => '/test/path',
            'defaults' => ['notInPath' => 'value'],
            'pathVariables' => [10 => 'notInPath']
        ]));

        $this->assertSame('/test/path', $urlBuilder->build('test'));
    }

    /**
     * @covers PitchBlade\Router\UrlBuilder::__construct
     * @covers PitchBlade\Router\UrlBuilder::fillPath
     * @covers PitchBlade\Router\UrlBuilder::build
     */
    public function testBuildWithMultipleDefaults()
    {
        $urlBuilder = new UrlBuilder(new RoutesFaker([
            'path' => '/:test/:path',
            'defaults' => ['test' => 'value', 'path' => 'othervalue'],
            'pathVariables' => [0 => 'test', 1 => 'path']
        ]));

        $this->assertSame('/value/othervalue', $urlBuilder->build('test'));
    }

    /**
     * @covers PitchBlade\Router\UrlBuilder::__construct
     * @covers PitchBlade\Router\UrlBuilder::fillPath
     * @covers PitchBlade\Router\UrlBuilder::build
     */
    public function testBuildWithMultipleDefaultsSwitched()
    {
        $urlBuilder = new UrlBuilder(new RoutesFaker([
            'path' => '/:test/:path',
            'defaults' => ['path' => 'othervalue', 'test' => 'value'],
            'pathVariables' => [0 => 'test', 1 => 'path']
        ]));

        $this->assertSame('/value/othervalue', $urlBuilder->build('test'));
    }

    /**
     * @covers PitchBlade\Router\UrlBuilder::__construct
     * @covers PitchBlade\Router\UrlBuilder::fillPath
     * @covers PitchBlade\Router\UrlBuilder::build
     */
    public function testBuildWithMultipleDefaultsSwitchedPathVariables()
    {
        $urlBuilder = new UrlBuilder(new RoutesFaker([
            'path' => '/:test/:path',
            'defaults' => ['test' => 'value', 'path' => 'othervalue'],
            'pathVariables' => [1 => 'path', 0 => 'test']
        ]));

        $this->assertSame('/value/othervalue', $urlBuilder->build('test'));
    }

    /**
     * @covers PitchBlade\Router\UrlBuilder::__construct
     * @covers PitchBlade\Router\UrlBuilder::fillPath
     * @covers PitchBlade\Router\UrlBuilder::build
     */
    public function testBuildWithSingleParameter()
    {
        $urlBuilder = new UrlBuilder(new RoutesFaker([
            'path' => '/:test/path',
            'defaults' => [],
            'pathVariables' => [0 => 'test']
        ]));

        $this->assertSame('/value/path', $urlBuilder->build('test', ['test' => 'value']));
    }

    /**
     * @covers PitchBlade\Router\UrlBuilder::__construct
     * @covers PitchBlade\Router\UrlBuilder::fillPath
     * @covers PitchBlade\Router\UrlBuilder::build
     */
    public function testBuildWithSingleParameterOverridingDefault()
    {
        $urlBuilder = new UrlBuilder(new RoutesFaker([
            'path' => '/:test/path',
            'defaults' => ['test' => 'default'],
            'pathVariables' => [0 => 'test']
        ]));

        $this->assertSame('/custom/path', $urlBuilder->build('test', ['test' => 'custom']));
    }
}
