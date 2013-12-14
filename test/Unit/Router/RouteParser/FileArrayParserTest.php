<?php

namespace PitchBladeTest\Unit\Router\RouteParser;

use PitchBlade\Router\RouteParser\FileArrayParser;

class FileArrayParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\RouteParser\FileArrayParser::__construct
     * @covers PitchBlade\Router\RouteParser\FileArrayParser::parse
     */
    public function testParseSuccess()
    {
        $parser = new FileArrayParser($this->getMock('\\PitchBlade\\Router\\RouteParser\\Parser'));

        $this->assertNull($parser->parse(__DIR__ . '/../../../Data/valid-routes.php'));
    }

    /**
     * @covers PitchBlade\Router\RouteParser\FileArrayParser::__construct
     * @covers PitchBlade\Router\RouteParser\FileArrayParser::parse
     */
    public function testParseInvalidFile()
    {
        $parser = new FileArrayParser($this->getMock('\\PitchBlade\\Router\\RouteParser\\Parser'));

        $this->setExpectedException('\\PitchBlade\\Router\\RouteParser\\MissingFileException');

        $parser->parse(__DIR__ . '/../../../Data/nonexistent-routes.php');
    }

    /**
     * @covers PitchBlade\Router\RouteParser\FileArrayParser::__construct
     * @covers PitchBlade\Router\RouteParser\FileArrayParser::parse
     */
    public function testParseInvalidFileFormat()
    {
        $parser = new FileArrayParser($this->getMock('\\PitchBlade\\Router\\RouteParser\\Parser'));

        $this->setExpectedException('\\PitchBlade\\Router\\RouteParser\\InvalidFormatException');

        $parser->parse(__DIR__ . '/../../../Data/invalid-routes.php');
    }
}
