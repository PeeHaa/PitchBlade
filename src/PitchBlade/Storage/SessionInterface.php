<?php
/**
 * Session interface
 *
 * All classes which represent a session should implement this. This is useful for creating a mock session class.
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Storage
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Storage;

use PitchBlade\Storage\KeyValuePair;

/**
 * Session interface
 *
 * @category   PitchBlade
 * @package    Storage
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface SessionInterface extends KeyValuePair
{
    /**
     * Regenerates a new session id and initializes the session superglobal
     */
    public function regenerate();
}
