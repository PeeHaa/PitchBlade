<?php
/**
 * Index controller
 *
 * PHP version 5.4
 *
 * @category   PitchBladeDemo
 * @package    Controllers
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBladeDemo\Controllers;

use PitchBlade\Mvc\View\Viewable;

/**
 * Index controller
 *
 * @category   PitchBladeDemo
 * @package    Controllers
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Index
{
    /**
     * Renders the homepage
     *
     * @param \PitchBlade\Mvc\View\Viewable $view The view to render
     */
    public function frontPage(Viewable $view)
    {
        return $view->renderHtml();
    }
}
