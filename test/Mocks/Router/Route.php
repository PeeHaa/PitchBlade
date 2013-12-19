<?php
/**
 * This class represents a single route
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Mocks
 * @subpackage Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBladeTest\Mocks\Router;

use PitchBlade\Router\RequestMatchable;

/**
 * This class represents a single route
 *
 * @category   PitchBlade
 * @package    Mocks
 * @subpackage Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Route
{
    /**
     * @var string The name of the route
     */
    private $name;

    /**
     * @var string The path of the route
     */
    private $path;

    /**
     * @var array The data to return whether the request matches
     */
    private $requirements;

    /**
     * Creates the instance of the route
     *
     * @param string                              $name           The name of the route
     * @param string                              $path           The path of the route
     * @param array                               $requirements   Array of requirements to match the route against
     * @param string                              $view           The view belonging to this route
     * @param array                               $controller     The controller and action belonging to this route
     * @param \BareCMSLIb\Router\RequestMatchable $requestMatcher The request matcher which check whether the route
     *                                                            matches with a request
     * @param array                               $defaults       Optional defaults for path variables
     */
    public function __construct(
        $name,
        $path,
        array $requirements,
        $view,
        array $controller,
        RequestMatchable $requestMatcher,
        array $defaults = []
    )
    {
        $this->name         = $name;
        $this->path         = $path;
        $this->requirements = $requirements;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function matchesRequest()
    {
        return $this->requirements['test'];
    }

    public function getMapping()
    {
    }
}
