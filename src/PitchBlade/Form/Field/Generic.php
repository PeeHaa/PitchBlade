<?php
/**
 * Generic field
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Form
 * @subpackage Field
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Form\Field;

/**
 * Generic field
 *
 * @category   PitchBlade
 * @package    Form
 * @subpackage Field
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
abstract class Generic
{
    /**
     * @var string The name of the field
     */
    protected $name;

    /**
     * @var string The type of the field
     */
    protected $type;

    /**
     * @var null|string The raw value from the request
     */
    protected $rawValue;

    /**
     * @var null|string The class of the field
     */
    protected $class;

    /**
     * @var int The tab index of the field
     */
    protected $tabIndex;

    /**
     * @var array List of custom attributes
     */
    protected $attributes;

    /**
     * @var array The requirements of the data
     */
    protected $requirements = [];

    /**
     * @var array The valid options
     */
    protected $options = [];

    /**
     * @var string The default value
     */
    protected $default;

    /**
     * @var array The errors
     */
    protected $errors = [];

    /**
     * Creates instance
     *
     * @param string $name The name of the field
     * @param array  $data The data to construct the field
     */
    public function __construct($name, array $data)
    {
        $this->name = $name;

        if (array_key_exists('class', $data)) {
            $this->class = $data['class'];
        }

        if (array_key_exists('requirements', $data)) {
            $this->requirements = $data['requirements'];
        }

        if (array_key_exists('options', $data)) {
            $this->options = $data['options'];
        }

        if (array_key_exists('default', $data)) {
            $this->default = $data['default'];
        }

        if (array_key_exists('tabIndex', $data)) {
            $this->tabIndex = $data['tabIndex'];
        }

        if (array_key_exists('attributes', $data)) {
            $this->attributes = $data['attributes'];
        }
    }

    /**
     * Gets the name of the field
     *
     * @return string The name of the field
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the type of the field
     *
     * @return string The type of the field
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Gets the CSS class
     *
     * @return null|string The CSS class
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Sets the raw value from the request
     *
     * @param string $data The data from the request
     */
    public function setRawValue($data)
    {
        $this->rawValue = $data;
    }

    /**
     * Gets the raw (submitted) value of the field
     *
     * @return string The raw (submitted) value of the field
     */
    protected function getRawValue()
    {
        return trim($this->rawValue);
    }

    /**
     * Gets the value of the field
     *
     * @return string The value of the field
     */
    public function getValue()
    {
        if (trim($this->rawValue) !== '' && $this->rawValue !== null) {
            return trim($this->rawValue);
        }

        return $this->default;
    }

    /**
     * Gets the tabindex of the field
     *
     * @return null|int The tab index of the field
     */
    public function getTabIndex()
    {
        return $this->tabIndex;
    }

    /**
     * Gets the custom attributes of the field
     *
     * @return array The custom attributes of the field
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Gets the valid options of the field
     *
     * @param array The options of the field
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Checks whether the field is valid
     *
     * @return boolean True when the field is valid
     */
    public function isValid()
    {
        $trimmedValue = trim($this->getRawValue());

        if (!empty($this->options)) {
            if (!array_key_exists($this->getRawValue(), $this->options)) {
                $this->errors[] = 'invalid.value';
            }
        }

        if (array_key_exists('required', $this->requirements) && $trimmedValue === '') {
            $this->errors[] = 'required';
        }

        if (array_key_exists('min', $this->requirements) && mb_strlen($trimmedValue, 'UTF-8') < $this->requirements['min']) {
            $this->errors[] = 'min';
        }

        if (array_key_exists('max', $this->requirements) && mb_strlen($trimmedValue, 'UTF-8') > $this->requirements['max']) {
            $this->errors[] = 'max';
        }

        if (array_key_exists('regex', $this->requirements) && preg_match($this->requirements['regex'], $trimmedValue) !== 1) {
            $this->errors[] = 'pattern';
        }

        return !$this->hasErrors();
    }

    /**
     * Checks whether there are errors
     *
     * @return boolean True when there are errors
     */
    public function hasErrors()
    {
        if (empty($this->errors)) {
            return false;
        }

        return true;
    }

    /**
     * Gets the first error of the field
     *
     * @return null|string The last error if any or null when there were no errors
     */
    public function getFirstError()
    {
        if (!$this->hasErrors()) {
            return null;
        }

        return reset($this->errors);
    }
}
