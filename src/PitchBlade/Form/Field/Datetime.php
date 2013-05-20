<?php
/**
 * Datetime field
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

use PitchBlade\Form\Field\Text;

/**
 * Datetime field
 *
 * @category   PitchBlade
 * @package    Form
 * @subpackage Field
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Datetime extends Text
{
    /**
     * Create instance
     *
     * @param string $name The name of the field
     * @param array  $data The data to construct the field
     */
    public function __construct($name, array $data)
    {
        parent::__construct($name, $data);

        $this->type = 'datetime';
    }
}
