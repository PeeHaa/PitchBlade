<?php
/**
 * Exception which gets thrown when the roles don't contain a guest role
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Acl
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Acl;

/**
 * Exception which gets thrown when the roles don't contain a guest role
 *
 * @category   PitchBlade
 * @package    Acl
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class MissingGuestException extends \Exception
{
}
