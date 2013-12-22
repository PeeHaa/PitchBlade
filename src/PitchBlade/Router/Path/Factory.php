<?php
/**
 * Factory for creating paths
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage Path
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Router\Path;

/**
 * Factory for creating paths
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage Path
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Factory implements Builder
{
    /**
     * @var \PitchBlade\Router\Path\SegmentBuilder $segmentFactory Instance of a segment factory
     */
    private $segmentFactory;

    /**
     * Creates instance
     *
     * @param \PitchBlade\Router\Path\SegmentBuilder $segmentFactory Instance of a segment factory
     */
    public function __construct(SegmentBuilder $segmentFactory)
    {
        $this->segmentFactory = $segmentFactory;
    }

    /**
     * Creates new instance of a path
     *
     * @param string $path The raw path
     *
     * @return \PitchBlade\Router\Path\Path The built path
     */
    public function build($rawPath)
    {
        $path = new Path($rawPath);

        $path->parse($this->segmentFactory);

        return $path;
    }
}
