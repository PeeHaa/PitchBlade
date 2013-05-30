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
class FakeRoute implements AccessPoint
{
    private $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function getName()
    {
        return $this->data['name'];
    }

    public function matchesRequest()
    {
        return $this->data['matchesRequest'];
    }

    public function getDefaults()
    {
        return $this->data['defaults'];
    }

    public function getView()
    {
        return $this->data['view'];
    }

    public function getController()
    {
        return $this->data['controller'];
    }

    public function getDependencies()
    {
        return $this->data['dependencies'];
    }

    public function getAction()
    {
        return $this->data['action'];
    }

    public function getPathVariables()
    {
        return $this->data['pathVariables'];
    }

    public function getPath()
    {
        return $this->data['path'];
    }
}
