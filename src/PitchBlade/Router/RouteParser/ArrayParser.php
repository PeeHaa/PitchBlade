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
namespace PitchBlade\Router\RouteParser;

use PitchBlade\Router\RouteParser\Parser,
    PitchBlade\Router\Routable;

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
     * @var \PitchBlade\Router\Routable The routes collection
     */
    private $routesCollection;

    /**
     * Creates instance
     *
     * @param \PitchBlade\Router\Routable $routesCollection The routes collection
     */
    public function __construct(Routable $routesCollection)
    {
        $this->routesCollection = $routesCollection;
    }

    /**
     * Parses the routes formatted as an array
     *
     * @param array $routes The routes
     */
    public function parse(array $routes)
    {
        foreach ($routes as $name => $route) {
            if (array_key_exists('defaults', $route)) {
                $this->routesCollection->add(
                    $name,
                    $route['path'],
                    $route['requirements'],
                    $route['view'],
                    $route['controller'],
                    $route['defaults']
                );
            } else {
                $this->routesCollection->add(
                    $name,
                    $route['path'],
                    $route['requirements'],
                    $route['view'],
                    $route['controller']
                );
            }
        }
    }
}
