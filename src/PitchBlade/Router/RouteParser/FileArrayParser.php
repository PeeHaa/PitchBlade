<?php
/**
 * Routes parser based on a file which contains an array
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage RouteParser
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Router\RouteParser;

/**
 * Routes parser based on a file which contains an array
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage RouteParser
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class FileArrayParser
{
    /**
     * @var \PitchBlade\Router\RouteParser\Parser The actually parser of the routes
     */
   private $parser;

    /**
     * Creates instance
     *
     * @param \PitchBlade\Router\RouteParser\Parser $parser The actually parser of the routes
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * Reads the file and passes the routes to the actual parser
     *
     * @param string $routesFile The file containig the routes
     */
    public function parse($routesFile)
    {
        if (!file_exists($routesFile)) {
            throw new MissingFileException('The routes file (`' . $routesFile . '`) does not exist.');
        }

        require $routesFile;

        if (!isset($routes)) {
            throw new InvalidFormatException('The routes file (`' . $routesFile . '`) is invalid.');
        }

        $this->parser->parse($routes);
    }
}
