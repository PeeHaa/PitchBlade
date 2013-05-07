<?php
/**
 * Generates a random string using openssl
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Security
 * @subpackage Generator
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Security\Generator;

use PitchBlade\Security\Generator,
    PitchBlade\Security\Generator\UnsupportedAlgorithmException;

/**
 * Generates a random string using openssl
 *
 * @category   PitchBlade
 * @package    Security
 * @subpackage Generator
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class OpenSsl implements Generator
{
    /**
     * Creates instance
     *
     * @throws \PitchBlade\Security\Generator\UnsupportedCryptoException When mcrypt is not installed
     */
    public function __construct()
    {
        if (!function_exists('openssl_random_pseudo_bytes')) {
            throw new UnsupportedAlgorithmException('Openssl isn\'t installed on the system.');
        }
    }

    /**
     * Generates a random string
     *
     * @param int $length The length of the random string to be generated
     */
    public function generate($length)
    {
        return openssl_random_pseudo_bytes($length);
    }
}
