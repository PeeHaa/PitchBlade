<?php
/**
 * Interface for request matcher factories
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Router
 * @package    RequestMatcher
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Router\RequestMatcher;

use PitchBlade\Http\RequestData,
    PitchBlade\Acl\Verifiable,
    PitchBlade\Router\RequestMatcher\Matchable;

/**
 * Interface for request matcher factories
 *
 * @category   PitchBlade
 * @package    Router
 * @package    RequestMatcher
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Builder
{
    /**
     * Builds instances of RequestMatchers
     *
     * @param  string $type The type of RequestMatcher to build
     *
     * @return \PitchBlade\Http\RequestMatcher\Matchable The instance of the matchable
     * @throws \PitchBlade\Router\RequestMatcher\UnknownMatcherException When the matchable class doesn't exists
     * @throws \PitchBlade\Router\RequestMatcher\InvalidMatcherException When the possible matchable class doesn't
     *                                                                   implement the Matchable interface
     */
    public function build($type);
}
