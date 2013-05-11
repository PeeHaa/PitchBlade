<?php
/**
 * Dummy random string generator
 *
 * PHP version 5.4
 *
 * @category   PitchBladeTest_Mocks
 * @package    Security
 * @subpackage Generator
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBladeTest\Mocks\Security\Generator;

use PitchBlade\Security\Generator as SecurityGenerator;

/**
 * Dummy random string generator
 *
 * @category   PitchBladeTest_Mocks
 * @package    Security
 * @subpackage Generator
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Dots implements SecurityGenerator
{
    /**
     * Generates a random string
     *
     * @param int $length The length of the random string to be generated
     */
    public function generate($length)
    {
        return str_repeat('.', $length);
    }
}
