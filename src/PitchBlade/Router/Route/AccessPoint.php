<?php
/**
 * This interface is used by classes which represent a single route
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage Route
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Router\Route;

use PitchBlade\Network\Http\RequestData;

/**
 * This interface is used by classes which represent a single route
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage Route
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface AccessPoint
{
    /**
     * Adds a regex patterns as requirements for path variables
     *
     * @param array $requirements The regex patterns
     *
     * @return \PitchBlade\Router\Route\AccessPoint Instance of self
     */
    public function wherePattern(array $requirements);

    /**
     * Adds default values for path variables
     *
     * @param array $defaults The defaults
     *
     * @return \PitchBlade\Router\Route\AccessPoint Instance of self
     */
    public function defaults(array $defaults);

    /**
     * Gets the name of the route
     *
     * @return string The name of the route
     */
    public function getName();

    /**
     * Gets a path variable
     *
     * @param string $name The name of the variable to get
     *
     * @return string                                                  The value of the variable
     * @throws \PitchBlade\Router\Route\UndefinedPathVariableException When trying to access an undefined variable
     */
    public function getVariable($name);

    /**
     * Gets the callback of the route
     *
     * @return callable The callback of the route
     */
    public function getCallback();

    /**
     * Tries to match the current route against the request
     *
     * @param \PitchBlade\Network\Http\RequestData $request The request data
     *
     * @return boolean True when the route matches the request
     */
    public function matchesRequest(RequestData $request);
}
