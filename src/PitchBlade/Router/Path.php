<?php
/**
 * This class represents a path of a route
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
namespace PitchBlade\Router;

/**
 * This class represents a path of a route
 *
 * @category   PitchBlade
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Path implements PathParser
{
    /**
     * @var string The raw path
     */
    private $rawPath;

    /**
     * Creates instance
     *
     * @param string $rawPath The raw path
     */
    public function __construct($rawPath)
    {
        $this->rawPath = $rawPath;
    }
}
