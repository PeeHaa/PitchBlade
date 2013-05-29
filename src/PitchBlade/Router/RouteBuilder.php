<?php
/**
 * This interface is used by all routes factories
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Router;

use PitchBlade\Router\Route;

/**
 * This interface is used by all routes factories
 *
 * @category   PitchBlade
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface RouteBuilder
{
    /**
     * Builds instance of a route
     *
     * @param string $name         The name of the route
     * @param string $path         The path of the route
     * @param array  $requirements Array of requirements to match the route against
     * @param string $view         The view belonging to the route
     * @param array  $controller   The controller and action belonging to the route
     * @param array  $defaults     Optional default values of path variables
     *
     * @return \PitchBlade\Router\Route Instance of a route
     */
    public function build($name, $path, array $requirements, $view, array $controller, array $defaults = []);
}
