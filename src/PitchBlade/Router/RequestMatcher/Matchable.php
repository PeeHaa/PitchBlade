<?php
/**
 * Interface for classes that try to match requirements for a request
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Router
 * @package    RequestMatcher
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Router\RequestMatcher;

/**
 * Interface for classes that try to match requirements for a request
 *
 * @category   PitchBlade
 * @package    Router
 * @package    RequestMatcher
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Matchable
{
    /**
     * Check whether the requirements match
     *
     * @param mixed $requirement The requirement to check against
     *
     * @return boolean Whether the requirement matches
     */
    public function doesMatch($requirement);
}
