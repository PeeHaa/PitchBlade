<?php
/**
 * Menu service
 *
 * This class represents the main menu of the application
 *
 * PHP version 5.4
 *
 * @category   PitchBladeDemo
 * @package    Models
 * @subpackage Services
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBladeDemo\Models\Services;

/**
 * Menu service
 *
 * @category   PitchBladeDemo
 * @package    Models
 * @subpackage Services
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Menu
{
    /**
     * @var array The menu items of the application
     */
    private $menuItems = [];

    /**
     * Creates instance
     *
     * We are simply defining an array to represent the menu for demonstration purposes
     */
    public function __construct()
    {
        $this->menuItems = [
            'home' => [
                'url' => '/',
                'title' => 'Home',
                'isActive' => false,
                'children' => [],
            ],
            'docs' => [
                'url' => '/documentation',
                'title' => 'Documentation',
                'isActive' => false,
                'children' => [
                    'docs/getting-started' => [
                        'url' => '/documentation/getting-started',
                        'title' => 'Getting started',
                        'isActive' => false,
                    ],
                ],
            ],
        ];
    }

    /**
     * Gets the main menu of the application
     *
     * @param null|string $activeItem The currently active menu item
     *
     * @return array The menu as a tree
     */
    public function getMenu($activeItem = null)
    {
        $this->activateMenuItem($activeItem);

        return $this->menuItems;
    }

    /**
     * Activates the currently active menu item
     *
     * @param null|string $activeItem The currently active menu item
     */
    private function activateMenuItem($activeItem = null)
    {
        $this->deactivateAllMenuItems();

        if ($activeItem === null) {
            return;
        }

        foreach ($this->menuItems as $menuId => $menuItem) {
            if ($menuId === $activeItem) {
                $this->menuItems[$menuId]['isActive'] = true;
            }

            foreach ($menuItem['children'] as $childId => $childItem) {
                if ($childId === $activeItem) {
                    $this->menuItems[$menuId]['isActive'] = true;
                    $this->menuItems[$menuId]['children'][$childId]['isActive'] = false;
                }
            }
        }
    }

    /**
     * Deactivates all menu items
     */
    private function deactivateAllMenuItems()
    {
        foreach ($this->menuItems as $menuId => $menuItem) {
            $this->menuItems[$menuId]['isActive'] = false;

            foreach ($menuItem['children'] as $childId => $childItem) {
                $this->menuItems[$menuId]['children'][$childId]['isActive'] = false;
            }
        }
    }
}
