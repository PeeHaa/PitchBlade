<?php
/**
 * This class represents a single route
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Mocks
 * @subpackage Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBladeTest\Mocks\Router;

use PitchBlade\Router\AccessPoint,
    PitchBlade\Router\RequestMatchable;

/**
 * This class represents a single route
 *
 * @category   PitchBlade
 * @package    Mocks
 * @subpackage Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class RouteWithPathVariables implements AccessPoint
{
    /**
     * @var string The name of the route
     */
    private $name;

    /**
     * @var array The data to return whether the request matches
     */
    private $requirements;

    public function getName()
    {
        return $this->name;
    }

    public function matchesRequest()
    {
        return $this->requirements['test'];
    }

    public function getDefaults()
    {
        return [];
    }

    public function getView()
    {
        return '\\PitchBladeTest\\Mocks\\Mvc\\View\\DummyView';
    }

    public function getController()
    {
        return '\\PitchBladeTest\\Mocks\\Mvc\\Controller\\DummyController';
    }

    public function getDependencies()
    {
        return ['\\PitchBladeTest\\Mocks\\Mvc\\Model\\DummyDependency'];
    }

    public function getAction()
    {
        return 'testActionWithDependency';
    }

    public function getPathVariables()
    {
        return [0 => 'var1', 1=> 'var2'];
    }

    public function getPath()
    {
        return '';
    }
}
