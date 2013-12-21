<?php
/**
 * Interface for factories for creating routes
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage Route
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Router\Route;

/**
 * Interface for factories for creating routes
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage Route
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Builder
{
    /**
     * Creates new instance of a route
     *
     * @param string   $name     The identifier for the route
     * @param string   $rawPath  The raw path of the route
     * @param callable $callback The callback that is run when the route is called
     *
     * @return \PitchBlade\Router\Route\AccessPoint The built route
     */
    public function build($name, $rawPath, callable $callback);
}
