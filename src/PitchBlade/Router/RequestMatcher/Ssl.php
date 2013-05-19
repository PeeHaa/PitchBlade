<?php
/**
 * Check whether a request matches with SSL requirements
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

use PitchBlade\Http\RequestData,
    PitchBlade\Router\RequestMatcher\Matchable;

/**
 * Check whether a request matches with SSL requirements
 *
 * @category   PitchBlade
 * @package    Router
 * @package    RequestMatcher
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Ssl implements Matchable
{
    /**
     * @var \PitchBlade\Http\RequestData The request
     */
    private $request;

    /**
     * Creates instance
     *
     * @param \PitchBlade\Http\RequestData $request The request to check for requirements
     */
    public function __construct(RequestData $request)
    {
        $this->request = $request;
    }

    /**
     * Check whether the requirements match
     *
     * @param boolean $requirement The requirement to check against
     *
     * @return boolean Whether the requirement matches
     */
    public function doesMatch($requirement)
    {
        if ($this->request->isSsl() === $requirement) {
            return true;
        }

        return false;
    }
}
