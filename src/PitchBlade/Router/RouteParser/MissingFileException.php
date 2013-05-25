<?php
/**
 * Exception which gets thrown when trying to load a routes files which doesn't exists
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage RouteParser
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Router\RouteParser;

/**
 * Exception which gets thrown when trying to load a routes files which doesn't exists
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage RouteParser
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class MissingFileException extends \Exception
{
}
