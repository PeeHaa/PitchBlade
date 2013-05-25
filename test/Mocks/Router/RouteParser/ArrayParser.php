<?php
/**
 * Routes parser based on array input. This class adds routes to a routes collection
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
namespace PitchBladeTest\Mocks\Router\RouteParser;

use PitchBlade\Router\RouteParser\Parser;

/**
 * Routes parser based on array input. This class adds routes to a routes collection
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage RouteParser
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class ArrayParser implements Parser
{
    /**
     * Parses the routes formatted as an array
     *
     * @param array $routes The routes
     */
    public function parse(array $routes)
    {
    }
}
