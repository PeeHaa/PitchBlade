<?php
/**
 * This class represents a path of a route
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage Path
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Router\Path;

/**
 * This class represents a path of a route
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage Path
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Path implements Parser
{
    /**
     * @var string The raw path
     */
    private $rawPath;

    /**
     * @var array The individual segments that make the path
     */
    private $segments = [];

    /**
     * Creates instance
     *
     * @param string $rawPath The raw path
     */
    public function __construct($rawPath)
    {
        $this->rawPath = $rawPath;
    }

    /**
     * Parses the path into individual segments
     *
     * @param PitchBlade\Router\Path\SegmentBuilder $factory Instance of a segment factory
     */
    public function parse(SegmentBuilder $factory)
    {
        $segments = explode('/', trim($this->rawPath, '/'));

        foreach ($segments as $segment) {
            $this->segments[] = $factory->build($segment);
        }
    }

    /**
     * Gets the segments of the path
     *
     * @return array The segments of the path
     */
    public function getParts()
    {
        return $this->segments;
    }
}
