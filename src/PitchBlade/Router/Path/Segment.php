<?php
/**
 * Interface for classes that represent a single part of the URI path
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @subpackage Path
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Router\Path;

/**
 * Interface for classes that represent a single part of the URI path
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage Path
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Segment
{
    /**
     * Parses the part to check whether it is variable and/or optional
     */
    public function parse();

    /**
     * Checks whether the part is variable
     *
     * @return boolean True when the part is variable
     */
    public function isVariable();

    /**
     * Checks whether the part is variable
     *
     * @return boolean True when the part is variable
     */
    public function isOptional();

    /**
     * Gets the parsed value
     *
     * @return string The parsed value
     */
    public function getValue();
}
