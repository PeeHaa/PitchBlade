<?php
/**
 * Main menu view
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
namespace PitchBladeDemo\Views\Blocks;

use PitchBlade\Mvc\View\View,
    PitchBlade\Mvc\View\Viewable;

/**
 * Main menu view
 *
 * @category   PitchBladeDemo
 * @package    Views
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class MainMenu extends View implements Viewable
{
    /**
     * Render the view based on dynamic variables and template(s)
     *
     * @param array $activeItem The currently active menu item
     *
     * @return string The rendered view
     */
    public function renderHtml(array $data = [])
    {
        $menuService = $this->serviceFactory->build('Services\Menu');

        $this->mainMenuTree = $menuService->getMenu($data['activeItem']);

        return $this->render(__DIR__ . '/../../templates/blocks/main-menu.phtml');
    }
}
