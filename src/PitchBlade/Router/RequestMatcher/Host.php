<?php
/**
 * Check whether a request matches with host requirements
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

use PitchBlade\Network\Http\RequestData;

/**
 * Check whether a request matches with host requirements
 *
 * @category   PitchBlade
 * @package    Router
 * @package    RequestMatcher
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Host implements Matchable
{
    /**
     * @var \PitchBlade\Network\Http\Request The request
     */
    private $request;

    /**
     * Creates instance
     *
     * @param \PitchBlade\Network\Http\RequestData $request The request to check for requirements
     */
    public function __construct(RequestData $request)
    {
        $this->request = $request;
    }

    /**
     * Check whether the requirements match
     *
     * @param string $requirement The requirement to check against (regex pattern)
     *
     * @return boolean Whether the requirement matches
     */
    public function doesMatch($requirement)
    {
        if (preg_match($requirement, $this->request->server('SERVER_NAME')) === 1) {
            return true;
        }

        return false;
    }
}
