<?php
/**
 * Select field
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
 * Select field
 *
 * @category   PitchBlade
 * @package    Form
 * @subpackage Field
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class MultiSelectBucket extends Generic
{
    /**
     * @var string The default value
     */
    protected $default = [];

    /**
     * @var null|string The raw value from the request
     */
    protected $rawValue = [];

    /**
     * Create instance
     *
     * @param string $name The name of the field
     * @param array  $data The data to construct the field
     */
    public function __construct($name, array $data)
    {
        parent::__construct($name, $data);

        $this->type = 'multi-select-bucket';

        if (array_key_exists('options', $data)) {
            $this->options = $data['options'];
        }
    }

    /**
     * Gets the raw (submitted) value of the field
     *
     * @return string The raw (submitted) value of the field
     */
    protected function getRawValue()
    {
        return $this->rawValue;
    }

    /**
     * Gets the value of the field
     *
     * @return string The value of the field
     */
    public function getValue()
    {
        if (!empty($this->rawValue)) {
            return json_decode($this->rawValue, true);
        }

        return $this->default;
    }

    /**
     * Checks whether the field is valid
     *
     * @return boolean True when the field is valid
     */
    public function isValid()
    {
        if (!empty($this->options)) {
            foreach ($this->getValue() as $key => $value) {
                if (!array_key_exists($key, $this->options)) {
                    $this->errors[] = 'invalid.value';
                }
            }
        }

        // fuck you too PHP
        $value = $this->getValue();

        if (array_key_exists('required', $this->requirements) && empty($value)) {
            $this->errors[] = 'required';
        }

        return !$this->hasErrors();
    }
}
