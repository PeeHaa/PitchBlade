<?php
/**
 * This class represents a single route
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

use PitchBlade\Router\RequestMatchable;

/**
 * This class represents a single route
 *
 * @category   PitchBlade
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Route
{
    /**
     * @var string The name of this route
     */
    private $name;

    /**
     * @var string The path of the route
     */
    private $path;

    /**
     * @var array The requirements of this route
     */
    private $requirements;

    /**
     * @var string The view of this route
     */
    private $view;

    /**
     * @var array The controller and action of this route
     */
    private $controller;

    /**
     * @var \PitchBlade\Router\RequestMatchable The request matcher which check whether the route matches with a request
     */
    private $requestMatcher;

    /**
     * @var array The (optional) mapping of path variable in the route
     */
    private $mapping;

    /**
     * Creates the instance of the route
     *
     * @param string                               $name           The name of the route
     * @param string                               $path           The path of the route
     * @param array                                $requirements   Array of requirements to match the route against
     * @param string                               $view           The view belonging to this route
     * @param array                                $controller     The controller and action belonging to this route
     * @param \PitchBlade\Router\RequestMatchable  $requestMatcher The request matcher which check whether the route
     *                                                             matches with a request
     * @param array                                $mapping        Optional mapping of path parts to request variables
     */
    public function __construct(
        $name,
        $path,
        array $requirements,
        $view,
        array $controller,
        RequestMatchable $requestMatcher,
        array $mapping = []
    )
    {
        $this->name           = $name;
        $this->path           = $path;
        $this->requirements   = $requirements;
        $this->view           = $view;
        $this->controller     = $controller;
        $this->requestMatcher = $requestMatcher;
        $this->mapping        = $mapping;
    }

    /**
     * Checks whether the route matches the request
     *
     * @return boolean Whether the route matches the request
     */
    public function matchesRequest()
    {
        return $this->requestMatcher->doesMatch($this->requirements);
    }

    /**
     * Gets the path of the route
     *
     * @return string The path of the route
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Get the controller of the route
     *
     * @return string The controller
     */
    public function getController()
    {
        return $this->controller['name'];
    }

    /**
     * Get the action of the route
     *
     * @return string The action
     */
    public function getAction()
    {
        return $this->controller['action'];
    }

    /**
     * Get the dependencies
     *
     * @return array The dependencies
     */
    public function getDependencies()
    {
        if (!array_key_exists('dependencies', $this->controller)) {
            return [];
        }

        return $this->controller['dependencies'];
    }

    /**
     * Get the view of the route
     *
     * @return string The view
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Get the mapping of the route
     *
     * @return array The mapping
     */
    public function getMapping()
    {
        return $this->mapping;
    }
}
