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
namespace PitchBlade\Acl;

use PitchBlade\Storage\SessionInterface;

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
     * @var \BareCMSLib\Storage\Session The user session
     */
    private $session;

    /**
     * The name of the guest role (i.e. when somebody is not logged in)
     */
    private $guestRole;

    /**
     * @var array The roles of the system
     */
    private $roles = [];

    /**
     * @var string The name of the user roel of the current user (cache)
     */
    private $userRole;

    /**
     * Creates instance
     *
     * @param string                               $guestRole The name of the guestrole
     * @param \PitchBlade\Storage\SessionInterface $session   The user session
     */
    public function __construct(SessionInterface $session, $guestRole = 'guest')
    {
        $this->session   = $session;
        $this->guestRole = $guestRole;
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
        $parsedRoles = [];
        foreach ($roles as $role => $options) {
            if (!array_key_exists('accesslevel', $options)) {
                throw new MissingAccesslevelException(
                    'No accesslevel defined for the role (`' . $role . '`).'
                );
            }

            if (!is_int($options['accesslevel'])) {
                throw new InvalidAccesslevelException(
                    'Accesslevel is not an integer for the role (`' . $role . '`).'
                );
            }

            $this->roles[$role] = $options;
        }

        if (!array_key_exists($this->guestRole, $this->roles)) {
            throw new MissingGuestException('Roles must contain a guest role (`' . $this->guestRole . '`).');
        }
    }

    /**
     * Gets the role of the current user
     *
     * @return string The name of role of the current user
     * @throws \PitchBlade\Acl\InvalidRoleException When the user's role is not defined
     */
    private function getUserRole()
    {
        if ($this->userRole !== null) {
            return $this->userRole;
        }

        $role = $this->guestRole;
        if ($this->session->isKeyValid('user')) {
            $user = $this->session->get('user');

            if (array_key_exists('role', $user)) {
                $role = $user['role'];
            }
        }

        if (!array_key_exists($role, $this->roles)) {
            throw new InvalidRoleException('The current user\'s role (`' . $role . '`) is not defined.');
        }

        $this->userRole = $role;

        return $role;
    }

    /**
     * Gets the accesslevel of a role
     *
     * @param string The name of the role
     *
     * @return int The accesslevel of the role
     * @throws \PitchBlade\Acl\InvalidRoleException When the user's role is not defined
     */
    private function getAccesslevelOfRole($role)
    {
        if (!array_key_exists($role, $this->roles)) {
            throw new InvalidRoleException('The current user\'s role (`' . $role . '`) is not defined.');
        }

        return $this->roles[$role]['accesslevel'];
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
        $userRole = $this->getUserRole();

        if ($permission == $userRole) {
            return true;
        }

        return false;
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
        $userRole = $this->getUserRole();

        if ($this->getAccesslevelOfRole($userRole) >= $this->getAccesslevelOfRole($permission)) {
            return true;
        }

        return false;
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
        $userRole = $this->getUserRole();

        if ($this->getAccesslevelOfRole($userRole) <= $this->getAccesslevelOfRole($permission)) {
            return true;
        }

        return false;
    }
}
