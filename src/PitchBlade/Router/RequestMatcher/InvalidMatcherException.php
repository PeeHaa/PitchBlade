<?php
/**
 * Exception which gets thrown when trying to load a class which doesn't
 * implement a matcher interface
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage RequestMatcher
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Router\RequestMatcher;

/**
 * Exception which gets thrown when trying to load a class which doesn't
 * implement a matcher interface
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage RequestMatcher
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class InvalidMatcherException extends \Exception
{
}
