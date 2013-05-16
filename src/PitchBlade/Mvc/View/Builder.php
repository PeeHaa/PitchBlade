<?php
/**
 * Interface for view factories
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Mvc
 * @subpackage View
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Mvc\View;

/**
 * Interface for view factories
 *
 * @category   PitchBlade
 * @package    Mvc
 * @subpackage View
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Builder
{
    /**
     * Build and return an instance of the requested view
     *
     * @param string $view The view to load
     *
     * @return \PitchBlade\Mvc\View\Viewable The requested view object
     */
    public function build($view);
}
