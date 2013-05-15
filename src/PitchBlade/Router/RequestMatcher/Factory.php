<?php
/**
 * Builds the request matchers for the different types in the request
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

use PitchBlade\Router\RequestMatcher\Buildable,
    PitchBlade\Http\RequestData,
    PitchBlade\Acl\Verifiable,
    PitchBlade\Router\RequestMatcher\Matchable,
    PitchBlade\Router\RequestMatcher\UnknownMatcherException,
    PitchBlade\Router\RequestMatcher\InvalidMatcherException;

/**
 * Builds the request matchers for the different types in the request
 *
 * @category   PitchBlade
 * @package    Router
 * @package    RequestMatcher
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Factory implements Buildable
{
    /**
     * @var \PitchBlade\Http\Request The request to check whether it matches with the requirements
     */
    private $request;

    /**
     * @var \PitchBlade\Acl\Verifiable The access control list
     */
    private $acl;

    /**
     * Creates instance
     *
     * @param \PitchBlade\Http\RequestData $request The request to check whether it matches with the requirements
     * @param \PitchBlade\Acl\Verifiable   $acl     The access control list
     */
    public function __construct(RequestData $request, Verifiable $acl)
    {
        $this->request = $request;
        $this->acl     = $acl;
    }

    /**
     * Builds instances of RequestMatchers
     *
     * @param string $type The type of RequestMatcher to build
     *
     * @return \PitchBlade\Http\RequestMatcher\Matchable The instance of the matchable
     * @throws \PitchBlade\Router\RequestMatcher\UnknownMatcherException When the matchable class doesn't exists
     * @throws \PitchBlade\Router\RequestMatcher\InvalidMatcherException When the possible matchable class doesn't
     *                                                                   implement the Matchable interface
     */
    public function build($type)
    {
        $class = '\\BareCMSLib\\Router\\RequestMatcher\\' . ucfirst(strtolower($type));

        if (!class_exists($class)) {
            throw new UnknownMatcherException('Unknown RequestMatcher (`' . $class . '`).');
        }

        if ($type == 'permissions') {
            $matcher = new $class($this->acl);
        } else {
            $matcher = new $class($this->request);
        }

        if (!($matcher instanceof Matchable)) {
            throw new InvalidMatcherException('Class (`' . $class . '`) does not implement the RequestMatcher interface.');
        }

        return $matcher;
    }
}