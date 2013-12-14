<?php
/**
 * Interface for route parsers
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
 * Interface for route parsers
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage RouteParser
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Parser
{
    /**
     * Parses the routes formatted as an array
     *
     * @param array $routes The routes
     */
    public function parse(array $routes);
}
