<?php
/**
 * An ACL container. This class provides a secure container from which the controller actions will be called
 * after checking the permissions
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Acl
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBladeTest\Mocks\Acl;

use PitchBlade\Acl\Verifiable,
    PitchBlade\Storage\SessionInterface,
    PitchBlade\Acl\MissingAccesslevelException,
    PitchBlade\Acl\InvalidAccesslevelException,
    PitchBlade\Acl\MissingGuestException,
    PitchBlade\Acl\InvalidRoleException;

/**
 * An ACL container. This class provides a secure container from which the controller actions will be called
 * after checking the permissions
 *
 * @category   PitchBlade
 * @package    Acl
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Verifier implements Verifiable
{
    /**
     * @var array
     */
    private $mockData;

    /**
     * Creates instance
     *
     * @param string                               $guestRole The name of the guestrole
     * @param \PitchBlade\Storage\SessionInterface $session   The user session
     */
    public function __construct(array $data)
    {
        $this->mockData = $data;
    }

    /**
     * Adds the roles of the system. The roles are simply an multidimensional array with the role as key. As value
     * the role contains an array with a numeric accesslevel (higher means a higher accesslevel).
     *
     * @param array $roles The roles of the system
     *
     * @throws \PitchBlade\Acl\MissingAccesslevelException When there is no accesslevel
     * @throws \PitchBlade\Acl\InvalidAccesslevelException When accesslevel is not an integer value
     * @throws \PitchBlade\Acl\MissingGuestException When roles do not contain a guest account
     */
    public function addRoles(array $roles)
    {
    }

    /**
     * Check whether the role exactly matches with the user's role
     *
     * @param string $permission The role needed to access an item
     *
     * @return boolean Whether the current user has access
     */
    public function doesRoleMatch($permission)
    {
        return $this->mockData['match'];
    }

    /**
     * Check whether the user role meets the minimum accesslevel
     *
     * @param string $permission The role needed to access an item
     *
     * @return boolean Whether the current user has access
     */
    public function doesRoleMatchMinimumAccesslevel($permission)
    {
        return $this->mockData['minimum'];
    }

    /**
     * Check whether the user role meets the maximum accesslevel
     *
     * @param string $permission The role needed to access an item
     *
     * @return boolean Whether the current user has access
     */
    public function doesRoleMatchMaximumAccesslevel($permission)
    {
        return $this->mockData['maximum'];
    }
}
