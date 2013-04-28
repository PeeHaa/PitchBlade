<?php
/**
 * Interface for a collection of routes
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

/**
 * Interface for a collection of routes
 *
 * @category   PitchBlade
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Routable
{
    /**
     * Adds a route to the list
     *
     * @param string $name         The name of the route
     * @param array  $requirements Array of requirements to match the route against
     * @param string $view         The view belonging to the new route
     * @param array  $controller   The controller and action belonging to the new route
     * @param array  $mapping      Optional mapping of path parts to request variables
     */
    public function add($name, array $requirements, $view, array $controller, array $mapping = []);

    /**
     * Gets a route by its name
     *
     * @param string $name The name of the route to find
     *
     * @return \PitchBlade\Router\Route The route
     * @throws \PitchBlade\Router\InvalidRouteException When no route matches the name
     */
    public function getRouteByName($name);

    /**
     * Gets a route by requestdata
     *
     * @return \PitchBlade\Router\Route The matching route
     */
    public function getRouteByRequest();
}
