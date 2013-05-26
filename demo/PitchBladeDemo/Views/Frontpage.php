<?php
/**
 * Frontpage view
 *
 * PHP version 5.4
 *
 * @category   PitchBladeDemo
 * @package    Views
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBladeDemo\Views;

use PitchBlade\Mvc\View\View,
    PitchBlade\Mvc\View\Viewable;

/**
 * Frontpage view
 *
 * @category   PitchBladeDemo
 * @package    Views
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Frontpage extends View implements Viewable
{
    /**
     * Render the view based on dynamic variables and template(s)
     *
     * @return string The rendered view
     */
    public function renderHtml()
    {
        $this->addMenu();
        $this->addTitle();

        return $this->renderPage(__DIR__ . '/../Templates/frontpage.phtml');
    }

    /**
     * Load the menu view and add the rendered menu to the view
     *
     * @return array The menu as a tree
     */
    private function addMenu()
    {
        $menuView = $this->viewFactory->build('Blocks\MainMenu');

        $this->mainMenuBlock = $menuView->renderHtml(['activeItem' => 'home']);
    }

    /**
     * Add the titles to the view
     */
    private function addTitle()
    {
        $this->title = 'Frontpage';
    }
}
