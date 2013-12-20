<?php
/**
 * This class represents all routes in the system
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
namespace PitchBladeTest\Mocks\Router;

use PitchBlade\Router\Routable;

/**
 * This class represents all routes in the system
 *
 * @category   PitchBlade
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Routes implements Routable
{

    /**
     * Adds a route to the list
     *
     * @param string $name         The name of the route
     * @param string $path         The path of the route
     * @param array  $requirements Array of requirements to match the route against
     * @param string $view         The view belonging to the new route
     * @param array  $controller   The controller and action belonging to the new route
     * @param array  $defaults     Optional default values of path variables
     */
    public function add($name, $path, array $requirements, $view, array $controller, array $defaults = [])
    {
    }

    /**
     * Gets a route by its name
     *
     * @param string $name The name of the route to find
     *
     * @return \PitchBlade\Router\Route                 The route
     * @throws \PitchBlade\Router\InvalidRouteException When no route matches the name
     */
    public function getRouteByName($name)
    {
    }

    /**
     * Gets a route by requestdata
     *
     * @return \PitchBlade\Router\Route                 The matching route
     * @throws \PitchBlade\Router\InvalidRouteException When no route matches the request
     */
    public function getRouteByRequest()
    {
    }
}
