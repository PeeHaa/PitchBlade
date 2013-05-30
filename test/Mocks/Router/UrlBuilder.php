<?php
/**
 * This class builds URLs based on a route name and optional arguments
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBladeTest\Mocks\Router;

use PitchBlade\Router\UrlBuildable;

/**
 * This class builds URLs based on a route name and optional arguments
 *
 * @category   PitchBlade
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class UrlBuilder implements UrlBuildable
{
    /**
     * Builds the URL based on the passed parameters and defaults
     *
     * @param string $name       The name of the route for which to build the URL
     * @param array  $parameters The optional parameters to build the URL with
     *
     * @return string The built URL
     * @throws \PicthBlade\Router\MissingUrlParameterException When missing URL parameters
     */
    public function build($name, array $parameters = [])
    {
        return '/the/path';
    }
}
