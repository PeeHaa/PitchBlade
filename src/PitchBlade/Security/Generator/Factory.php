<?php
/**
 * Factory which returns different generators
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

use PitchBlade\Security\Generator\Builder,
    PitchBlade\Security\Generator\InvalidGeneratorException;

/**
 * Factory which returns different generators
 *
 * @category   PitchBlade
 * @package    Security
 * @subpackage Generator
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Factory implements Builder
{
    /**
     * Builds a random string generator
     *
     * @param string $class The fully qualified class name
     *
     * @return \PitchBlade\Security\Generator The random string generator requested
     * @throws \PitchBlade\Security\Generator\InvalidGeneratorException If the generator can not be loaded
     */
    public function build($class)
    {
        if (!class_exists($class)) {
            throw new InvalidGeneratorException('Invalid random string generator (`' . $class . '`).');
        }

        return new $class();
    }
}
