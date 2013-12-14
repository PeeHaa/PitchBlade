<?php
/**
 * Check whether a request matches with permission requirements
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

use PitchBlade\Acl\Verifiable;

/**
 * Check whether a request matches with permission requirements
 *
 * @category   PitchBlade
 * @package    Router
 * @package    RequestMatcher
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Permissions implements Matchable
{
    /**
     * @var \PitchBlade\Acl\Verifiable The access control list
     */
    private $acl;

    /**
     * Creates instance
     *
     * @param \PitchBlade\Acl\Verifiable $acl Instance of the acl
     */
    public function __construct(Verifiable $acl)
    {
        $this->acl = $acl;
    }

    /**
     * Check whether the requirements match
     *
     * @param array $requirement The list of requirements to check against
     *
     * @return boolean Whether the requirement matches
     */
    public function doesMatch($requirement)
    {
        $match = true;

        foreach ($requirement as $role => $accesslevel) {
            switch ($role) {
                case 'match':
                    $match = $this->acl->doesRoleMatch($accesslevel);
                    break;

                case 'minimum':
                    $match = $this->acl->doesRoleMatchMinimumAccesslevel($accesslevel);
                    break;

                case 'maximum':
                    $match = $this->acl->doesRoleMatchMaximumAccesslevel($accesslevel);
                    break;
            }

            if ($match === false) {
                return false;
            }
        }

        return true;
    }
}
