<?php
/**
 * Text field
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
 * Text field
 *
 * @category   PitchBlade
 * @package    Form
 * @subpackage Field
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Email extends Text
{
    /**
     * @var null|string The placeholder of the field
     */
    private $placeholder;

    /**
     * Create instance
     *
     * @param string $name The name of the field
     * @param array  $data The data to construct the field
     */
    public function __construct($name, array $data)
    {
        parent::__construct($name, $data);

        if (array_key_exists('placeholder', $data)) {
            $this->placeholder = $data['placeholder'];
        }

        $this->type = 'email';
    }

    /**
     * Get the optional placeholder
     *
     * @return null|string The placeholder of the field
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * Checks whether the field is valid
     *
     * @return boolean True when the field is valid
     */
    public function isValid()
    {
        $trimmedValue = trim($this->getRawValue());

        if ($trimmedValue !== null && $trimmedValue !== '' && !filter_var($trimmedValue, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'invalid.value';
        }

        return parent::isValid();
    }
}
