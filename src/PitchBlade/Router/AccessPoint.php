<?php
/**
 * This interface is used by classes which represent a single route
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
 * This interface is used by classes which represent a single route
 *
 * @category   PitchBlade
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface AccessPoint
{
    /**
     * Checks whether the route matches the request
     *
     * @return boolean Whether the route matches the request
     */
    public function matchesRequest();

    /**
     * Gets the path of the route
     *
     * @return string The path of the route
     */
    public function getPath();

    /**
     * Gets the controller of the route
     *
     * @return string The controller
     */
    public function getController();

    /**
     * Get the action of the route
     *
     * @return string The action
     */
    public function getAction();

    /**
     * Gets the dependencies
     *
     * @return array The dependencies
     */
    public function getDependencies();

    /**
     * Gets the view of the route
     *
     * @return string The view
     */
    public function getView();

    /**
     * Gets the path variables
     *
     * @return array The variables in the path
     */
    public function getPathVariables();

    /**
     * Gets the default values of the path variables
     *
     * @return array The default values of the path variables
     */
    public function getDefaults();
}
