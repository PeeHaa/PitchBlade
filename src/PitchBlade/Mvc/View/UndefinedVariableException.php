<?php
/**
 * Exception which gets thrown when trying to access an undefined view variable
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Mvc
 * @subpackage Model
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Mvc\View;

/**
 * Exception which gets thrown when trying to access an undefined view variable
 *
 * @category   PitchBlade
 * @package    Mvc
 * @subpackage Model
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class UndefinedVariableException extends \Exception
{
}
