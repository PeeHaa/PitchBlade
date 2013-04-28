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
namespace PitchBlade\Router;

use PitchBlade\Router\Routable,
    PitchBlade\Router\RouteBuilder,
    PitchBlade\Http\RequestData,
    PitchBlade\Router\InvalidRouteException;

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
     * @var \PitchBlade\Router\RouteBuilder
     */
    private $routeFactory;

    /**
     * @var array The list of all routes
     */
    private $routes = [];

    /**
     * Creates instance of the routes
     *
     * @param \PitchBlade\Router\RouteBuilder $routeFactory
     */
    public function __construct(RouteBuilder $routeFactory)
    {
        $this->routeFactory = $routeFactory;
    }

    /**
     * Adds a route to the list
     *
     * @param string $name         The name of the route
     * @param array  $requirements Array of requirements to match the route against
     * @param string $view         The view belonging to the new route
     * @param array  $controller   The controller and action belonging to the new route
     * @param array  $mapping      Optional mapping of path parts to request variables
     */
    public function add($name, array $requirements, $view, array $controller, array $mapping = [])
    {
        $this->routes[$name] = $this->routeFactory->build($name, $requirements, $view, $controller, $mapping);
    }

    /**
     * Gets a route by its name
     *
     * @param string $name The name of the route to find
     *
     * @return \PitchBlade\Router\Route The route
     * @throws \PitchBlade\Router\InvalidRouteException When no route matches the name
     */
    public function getRouteByName($name)
    {
        if (!array_key_exists($name, $this->routes)) {
            throw new InvalidRouteException('No route found with the supplied name (`' . $name . '`).');
        }

        return $this->routes[$name];
    }

    /**
     * Gets a route by requestdata
     *
     * @param \PitchBlade\Http\RequestData $request The data of the request against which to match the route
     *
     * @return \PitchBlade\Router\Route The matching route
     */
    public function getRouteByRequest(RequestData $request)
    {
        foreach ($this->routes as $route) {
            if (!$route->matchesRequest()) {
                continue;
            }

            return $route;
        }
    }
}
