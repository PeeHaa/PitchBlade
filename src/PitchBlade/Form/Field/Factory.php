<?php
/**
 * Form field factory
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

use PitchBlade\Form\Field\Builder;

/**
 * Form field factory
 *
 * @category   PitchBlade
 * @package    Form
 * @subpackage Field
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Factory implements Builder
{
    /**
     * Build field instance
     *
     * @param string $name The name of the field
     * @param array  $data The data to build the field
     *
     * @return \BareCMSLib\Form\Field\Generic The field
     */
    public function build($name, array $data = [])
    {
        $formFieldClass = $data['type'];
        if (strpos($data['type'], '\\') !== 0) {
            $formFieldClass = '\\PitchBlade\\Form\\Field\\' . ucfirst($data['type']);
        }

        return new $formFieldClass($name, $data);
    }
}
