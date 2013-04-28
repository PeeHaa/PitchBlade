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
namespace PitchBlade\Security;

use PitchBlade\Security\CsrfToken\StorageMedium;

/**
 * Provides a csrf token to secure forms
 *
 * @category   PitchBlade
 * @package    Security
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class CsrfToken
{
    /**
     * @var \PitchBlade\Security\CsrfToken\StorageMedium
     */
    private $storageMedium;

    /**
     * Creates instance
     *
     * @param \PitchBlade\Security\CsrfToken\StorageMedium $storageMedium The storage medium
     */
    public function __construct(StorageMedium $storageMedium)
    {
        $this->storageMedium = $storageMedium;
    }

    /**
     * Gets the stored CSRF token
     *
     * @return string The stored CSRF token
     */
    public function getToken()
    {
        $csrfToken = $this->storageMedium->get();
        if ($csrfToken === null) {
            $csrfToken = $this->generateToken();
        }

        $this->storageMedium->set($csrfToken);

        return $csrfToken;
    }

    /**
     * Validates the supplied token against the stored token
     *
     * @return boolean True when the supplied token matches the stored token
     */
    public function validate($token)
    {
        return $token == $this->getToken();
    }

    /**
     * Regenerates a new token
     */
    public function regenerateToken()
    {
        $this->storageMedium->set($this->generateToken());
    }

    /**
     * Generates a new cryptographically secure CSRF token
     *
     * @param int $length The length of the token to be generated
     *
     * @return string The generated CSRF token
     */
    private function generateToken($rawLength = 128)
    {
        $buffer = '';
        $raw_length = (int) ($rawLength * 3 / 4 + 1);
        $buffer_valid = false;
        if (function_exists('mcrypt_create_iv')) {
            $buffer = mcrypt_create_iv($raw_length, MCRYPT_DEV_URANDOM);
            if ($buffer) {
                $buffer_valid = true;
            }
        }
        if (!$buffer_valid && function_exists('openssl_random_pseudo_bytes')) {
            $buffer = openssl_random_pseudo_bytes($raw_length);
            if ($buffer) {
                $buffer_valid = true;
            }
        }
        if (!$buffer_valid && file_exists('/dev/urandom')) {
            $f = @fopen('/dev/urandom', 'r');
            if ($f) {
                $read = strlen($buffer);
                while ($read < $raw_length) {
                    $buffer .= fread($f, $raw_length - $read);
                    $read = strlen($buffer);
                }
                fclose($f);
                if ($read >= $raw_length) {
                    $buffer_valid = true;
                }
            }
        }
        if (!$buffer_valid || strlen($buffer) < $raw_length) {
            $bl = strlen($buffer);
            for ($i = 0; $i < $raw_length; $i++) {
                if ($i < $bl) {
                    $buffer[$i] = $buffer[$i] ^ chr(mt_rand(0, 255));
                } else {
                    $buffer .= chr(mt_rand(0, 255));
                }
            }
        }
        return str_replace(array('+', '"', '\'', '\\', '/', '=', '?', '&'), '', base64_encode($buffer));
    }
}
