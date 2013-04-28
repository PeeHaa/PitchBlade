<?php
/**
 * Matches a request against a set of requirements
 *
 * PHP version 5.4
 *
 * @category   PitchBladeTest
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
 * Matches a request against a set of requirements
 *
 * @category   PitchBladeTest
 * @package    Mocks
 * @subpackage Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class RequestMatcher implements RequestMatchable
{
    /**
     * Check whether the current request matches with the given requirements. The requirements should be supplied as
     * an array where the key is the type of requirement (i.e. path, method, ssl etc) and the value is the requirement
     * to check against
     *
     * @param array A list of requirements to match
     *
     * @return boolean Whether the request matches
     */
    public function doesMatch(array $requirements)
    {
        return true;
    }
}
