<?php
/**
 * This factory builds routes
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Router;

use PitchBlade\Router\RouteBuilder,
    PitchBlade\Router\RequestMatchable,
    PitchBlade\Router\Route;

/**
 * This factory builds routes
 *
 * @category   PitchBlade
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class RouteFactory implements RouteBuilder
{
    /**
     * @var \PitchBlade\Router\RequestMatchable Instance of a request matcher
     */
    private $requestMatcher;

    /**
     * Creates instance of the factory and caches the request matcher to be able to inject it into all created routes
     *
     * @param \PitchBlade\Router\RequestMatchable $requestMatcher Instance of a request matcher
     */
    public function __construct(RequestMatchable $requestMatcher)
    {
        $this->requestMatcher = $requestMatcher;
    }

    /**
     * Builds instance of a route
     *
     * @param string $name         The name of the route
     * @param string $path         The path of the route
     * @param array  $requirements Array of requirements to match the route against
     * @param string $view         The view belonging to the route
     * @param array  $controller   The controller and action belonging to the route
     * @param array  $mapping      Optional mapping of path parts to request variables
     *
     * @return \PitchBlade\Router\Route Instance of a route
     */
    public function build($name, $path, array $requirements, $view, array $controller, array $mapping = [])
    {
        return new Route($name, $path, $requirements, $view, $controller, $this->requestMatcher, $mapping);
    }
}
