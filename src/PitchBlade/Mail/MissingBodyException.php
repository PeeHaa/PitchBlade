<?php
/**
 * Exception which gets thrown when a mail message doesn't have a body
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Mail
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Mail;

/**
 * Exception which gets thrown when a mail message doesn't have a body
 *
 * @category   PitchBlade
 * @package    Mail
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class MissingBodyException extends \Exception
{
}
