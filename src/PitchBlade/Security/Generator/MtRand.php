<?php
/**
 * Generates a random string using mt_rand()
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

use PitchBlade\Security\Generator;

/**
 * Generates a random string using mt_rand()
 *
 * @category   PitchBlade
 * @package    Security
 * @subpackage Generator
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Urandom implements Generator
{
    /**
     * Generates a random string
     *
     * @param int $length The length of the random string to be generated
     */
    public function generate($length)
    {
        $buffer = '';

        for ($i = 0; $i < $length; $i++) {
            $buffer .= chr(mt_rand(0, 255));
        }

        return $buffer;
    }
}
