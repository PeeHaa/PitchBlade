<?php
/**
 * Factory for creating paths
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Router;

/**
 * Factory for creating paths
 *
 * @category   PitchBlade
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class PathFactory implements PathBuilder
{
    /**
     * Creates new instance of a path
     *
     * @param string $path The raw path
     *
     * @return \PitchBlade\Router\Path The built path
     */
    public function build($rawPath)
    {
        return new Path($rawPath);
    }
}
