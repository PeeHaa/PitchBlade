<?php
/**
 * This factory builds routes
 *
 * PHP version 5.4
 *
 * @category   PitchBladeTest
 * @package    Mocks
 * @subpackage Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBladeTest\Mocks\Router;

use PitchBlade\Router\RouteBuilder,
    PitchBladeTest\Mocks\Router\Route,
    PitchBladeTest\Mocks\Router\RequestMatcher;

/**
 * This factory builds routes
 *
 * @category   PitchBladeTest
 * @package    Mocks
 * @subpackage Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class RouteFactory implements RouteBuilder
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
     * @return string Instance of a route
     */
    public function build($name, $path, array $requirements, $view, array $controller, array $defaults = [])
    {
        return new Route($name, $path, $requirements, $view, [], new RequestMatcher());
    }
}