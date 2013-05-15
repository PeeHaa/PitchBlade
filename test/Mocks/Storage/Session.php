<?php
/**
 * Mock session class
 *
 * PHP version 5.4
 *
 * @category   PitchBladeTest
 * @package    Mocks
 * @subpackage Storage
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBladeTest\Mocks\Storage;

use PitchBlade\Storage\SessionInterface,
    PitchBlade\Storage\InvalidKeyException;

/**
 * Mock session class
 *
 * @category   PitchBladeTest
 * @subpackage Mocks
 * @package    Storage
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Session implements SessionInterface
{
    /**
     * @var array Provides a simple data container for the mock object
     */
    private $values = [];

    public function __construct($data = [])
    {
        $this->values = $data;
    }

    /**
     * Sets the value
     *
     * @param string $key   The key in which to store the value
     * @param mixed  $value The value to store
     */
    public function set($key, $value)
    {
        $this->values[$key] = $value;
    }

    /**
     * Gets a value from the session superglobal
     *
     * @param mixed $key The key of which to retrieve the value
     *
     * @return mixed The value
     * @throws \PitchBlade\Storage\InvalidKeyException When the key is not found
     */
    public function get($key)
    {
        if (!$this->isKeyValid($key)) {
            throw new InvalidKeyException('Key (`' . $key . '`) not found in session.');
        }

        return $this->values[$key];
    }

    /**
     * Check whether the supplied key is valid (i.e. does exist in the session superglobal)
     *
     * @param string $key The key to check
     *
     * @return boolean Whether the supplied key is valid
     */
    public function isKeyValid($key)
    {
        if (array_key_exists($key, $this->values)) {
            return true;
        }

        return false;
    }

    /**
     * Regenerates a new session id and initializes the session superglobal
     */
    public function regenerate()
    {
        $this->values = [];
    }
}
