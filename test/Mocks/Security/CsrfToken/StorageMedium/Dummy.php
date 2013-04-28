<?php
/**
 * Mock CSRF storage class
 *
 * PHP version 5.4
 *
 * @category      PitchBladeTest
 * @package       Mocks_Security
 * @subpackage    CsrfToken
 * @subsubpackage StorageMedium
 * @author        Pieter Hordijk <info@pieterhordijk.com>
 * @copyright     Copyright (c) 2013 Pieter Hordijk
 * @license       http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version       1.0.0
 */
namespace PitchBladeTest\Mocks\Security\CsrfToken\StorageMedium;

use PitchBlade\Security\CsrfToken\StorageMedium;

/**
 * Mock CSRF storage class
 *
 * @category      PitchBladeTest
 * @package       Mocks_Security
 * @subpackage    CsrfToken
 * @subsubpackage StorageMedium
 * @author        Pieter Hordijk <info@pieterhordijk.com>
 */
class Dummy implements StorageMedium
{
    /**
     * @var null|string Optional default value for the mocked object
     */
    private $value;

    /**
     * Creates instance
     *
     * @param string $value Optional default value for the mocked object
     */
    public function __construct($value = null)
    {
        $this->value = $value;
    }

    /**
     * Sets the CSRF token
     *
     * @param string $token The token to store
     */
    public function set($token)
    {
        $this->value = $token;
    }

    /**
     * Gets the CSRF token
     *
     * @return string|null The CSRF token or null when there isn't a token stored (yet)
     */
    public function get()
    {
        return $this->value;
    }
}
