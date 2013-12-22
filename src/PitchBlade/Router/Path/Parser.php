<?php
/**
 * Interface for route path parsers
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
 * Interface for route path parsers
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage Path
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Parser
{
    /**
     * Parses the path into individual segments
     *
     * @param PitchBlade\Router\Path\SegmentBuilder $factory Instance of a segment factory
     */
    public function parse(SegmentBuilder $factory);

    /**
     * Gets the segments of the path
     *
     * @return array The segments of the path
     */
    public function getParts();
}
