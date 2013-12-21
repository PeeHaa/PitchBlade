<?php
/**
 * Simple router which basically just represents a collection of routes
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

use PitchBlade\Router\Route\Builder;
use PitchBlade\Network\Http\RequestData;

/**
 * Simple router
 *
 * @category   PitchBlade
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Router
{
    /**
     * @var array LIst of all registered routes
     */
    private $routes = [
        'GET'  => [],
        'POST' => [],
    ];

    /**
     * @var \PitchBlade\Router\Route\Builder Instance of the route factory
     */
    private $routeFactory;

    /**
     * Creates instance
     *
     * @param \PitchBlade\Router\Route\Builder $routeFactory Instance of a route factory
     */
    public function __construct(Builder $routeFactory)
    {
        $this->routeFactory = $routeFactory;
    }

    /**
     * Adds a route to the collection
     *
     * @param string   $name     The identifier for the route
     * @param string   $type     The type (post/get) of the route
     * @param string   $path     The raw path of the route
     * @param callable $callback The callback that is run when the route is called
     *
     * @return \PitchBlade\Router\Route\AccessPoint       The route
     * @throws \PitchBlade\Router\DuplicateRouteException When trying to add an already defined route
     */
    private function addRoute($name, $type, $path, callable $callback)
    {
        if (array_key_exists($name, $this->routes[$type])) {
            throw new DuplicateRouteException('A `' . $type . '` route with the name `' . $name . '` already exists.');
        }

        $this->routes[$type][$name] = $this->routeFactory->build($name, $path, $callback);

        return $this->routes[$type][$name];
    }

    /**
     * Adds a GET route to the collection
     *
     * @param string   $name     The identifier for the route
     * @param string   $path     The raw path of the route
     * @param callable $callback The callback that is run when the route is called
     *
     * @return \PitchBlade\Router\Route\AccessPoint The route
     */
    public function get($name, $path, callable $callback)
    {
        return $this->addRoute($name, 'GET', $path, $callback);
    }

    /**
     * Adds a POST route to the collection
     *
     * @param string   $name     The identifier for the route
     * @param string   $path     The raw path of the route
     * @param callable $callback The callback that is run when the route is called
     *
     * @return \PitchBlade\Router\Route\AccessPoint The route
     */
    public function post($name, $path, callable $callback)
    {
        return $this->addRoute($name, 'POST', $path, $callback);
    }

    /**
     * Gets the route for he current request
     *
     * @param \PitchBlade\Network\Http\RequestData $request The request data
     *
     * @return \PitchBlade\Router\AccessPoint                The matching route
     * @throws \PitchBlade\Router\UnsupportedMethodException When the request contains an unspported method
     * @throws \PitchBlade\Router\NotFoundException          When no route matches
     */
    public function getRoute(RequestData $request)
    {
        if (!array_key_exists($request->getMethod(), $this->routes)) {
            throw new UnsupportedMethodException(
                'The `' . $request->getMethod() . '` method is currently not implemented.'
            );
        }

        foreach ($this->routes[$request->getMethod()] as $route) {
            if ($route->matchesRequest($request)) {
                return $route;
            }
        }

        throw new NotFoundException('No route matches the request.');
    }
}
