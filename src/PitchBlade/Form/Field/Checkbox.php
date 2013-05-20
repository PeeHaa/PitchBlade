<?php
/**
 * Checkbox field
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

use PitchBlade\Form\Field\Generic;

/**
 * Checkbox field
 *
 * @category   PitchBlade
 * @package    Form
 * @subpackage Field
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Checkbox extends Generic
{
    /**
     * @var null|string The label of the field
     */
    private $label;

    /**
     * Create instance
     *
     * @param string $name The name of the field
     * @param array  $data The data to construct the field
     */
    public function __construct($name, array $data)
    {
        parent::__construct($name, $data);

        if (array_key_exists('label', $data)) {
            $this->label = $data['label'];
        }

        $this->type = 'checkbox';
    }

    /**
     * Get the optional label
     *
     * @return null|string The label of the field
     */
    public function getLabel()
    {
        return $this->label;
    }
}
