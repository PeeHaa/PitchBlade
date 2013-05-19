<?php
/**
 * Form validation interface
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Form
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Form;

/**
 * Form validation interface
 *
 * @category   PitchBlade
 * @package    Form
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Validatable
{
    /**
     * Validate form
     *
     * @return boolean True when form is valid
     */
    public function isValid();
}
