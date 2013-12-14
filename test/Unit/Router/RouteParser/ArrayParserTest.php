<?php

namespace PitchBladeTest\Router\RouteParser;

use PitchBlade\Router\RouteParser\ArrayParser;

class ArrayParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\RouteParser\ArrayParser::__construct
     */
    public function testConstructCorrectInterface()
    {
        $parser = new ArrayParser($this->getMock('\\PitchBlade\\Router\\Routable'));

        $this->assertInstanceOf('\\PitchBlade\\Router\\RouteParser\\Parser', $parser);
    }

    /**
     * @covers PitchBlade\Router\RouteParser\ArrayParser::__construct
     * @covers PitchBlade\Router\RouteParser\ArrayParser::parse
     */
    public function testParseWithoutDefaults()
    {
        $parser = new ArrayParser($this->getMock('\\PitchBlade\\Router\\Routable'));

        $routes = [
            'with mapping' => [
                'path' => '/path/of/route',
                'requirements' => [],
                'view' => null,
                'controller' => [],
            ],
        ];

        $this->assertNull($parser->parse($routes));
    }

    /**
     * @covers PitchBlade\Router\RouteParser\ArrayParser::__construct
     * @covers PitchBlade\Router\RouteParser\ArrayParser::parse
     */
    public function testParseWithDefaults()
    {
        $parser = new ArrayParser($this->getMock('\\PitchBlade\\Router\\Routable'));

        $routes = [
            'with mapping' => [
                'path' => '/path/of/route',
                'requirements' => [],
                'view' => null,
                'controller' => [],
                'defaults' => [],
            ],
        ];

        $this->assertNull($parser->parse($routes));
    }
}
