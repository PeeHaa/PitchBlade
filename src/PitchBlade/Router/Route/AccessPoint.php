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
}
