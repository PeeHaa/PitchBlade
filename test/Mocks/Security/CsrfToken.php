<?php
/**
 * Provides a csrf token to secure forms and links
 *
 * It uses pieces of ircmaxell's password_compat library to generate pseudo random token
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Security
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @author     Anthony Ferrara <ircmaxell@php.net>
 * @copyright  Copyright (c) 2013 The authors
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBladeTest\Mocks\Security;

use PitchBlade\Security\TokenGenerator;

/**
 * Provides a csrf token to secure forms
 *
 * @category   PitchBlade
 * @package    Security
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class CsrfToken implements TokenGenerator
{
    /**
     * Gets the stored CSRF token
     *
     * @return string The stored CSRF token
     */
    public function getToken()
    {
    }

    /**
     * Validates the supplied token against the stored token
     *
     * @return boolean True when the supplied token matches the stored token
     */
    public function validate($token)
    {
    }

    /**
     * Regenerates a new token
     */
    public function regenerateToken()
    {
    }
}
