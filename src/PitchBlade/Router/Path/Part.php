<?php
/**
 * This class represents a single part of the URI path
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
 * This class represents a single part of the URI path
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage Path
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Part
{
    /**
     * @var string The raw value of the path part
     */
    private $rawValue;

    /**
     * @var string The parsed value of the path part
     */
    private $value;

    /**
     * @var boolean Whether the path part is a variable
     */
    private $variable = false;

    /**
     * @var boolean Whether the path part is optional
     */
    private $optional = false;

    /**
     * Creates instance
     *
     * @param string $rawValue The raw value of the path part
     */
    public function __construct($rawValue)
    {
        $this->rawValue = $rawValue;
    }

    /**
     * Parses the part to check whether it is variable and/or optional
     */
    public function parse()
    {
        $this->variable = $this->hasVariableStartIdentifier() && $this->hasVariableEndIdentifier();

        $start = 0;
        $length = strlen($this->rawValue);

        if ($this->variable) {
            $start++;
            $length -= 2;

            $this->optional = substr_compare($this->rawValue, '?}', -2) === 0;
        }

        if ($this->optional) {
            $length--;
        }

        $this->value = substr($this->rawValue, $start, $length);
    }

    /**
     * Checks whether the part contains the variable start identifier
     *
     * @return boolean True when the part contains the variable start identifier
     */
    private function hasVariableStartIdentifier()
    {
        return strpos($this->rawValue, '{') === 0;
    }

    /**
     * Checks whether the part contains the variable end identifier
     *
     * @return boolean True when the part contains the variable end identifier
     */
    private function hasVariableEndIdentifier()
    {
        return substr_compare($this->rawValue, '}', -1) === 0;
    }

    /**
     * Checks whether the part is variable
     *
     * @return boolean True when the part is variable
     */
    public function isVariable()
    {
        return $this->variable;
    }

    /**
     * Checks whether the part is variable
     *
     * @return boolean True when the part is variable
     */
    public function isOptional()
    {
        return $this->optional;
    }

    /**
     * Gets the parsed value
     *
     * @return string The parsed value
     */
    public function getValue()
    {
        return $this->value;
    }
}
