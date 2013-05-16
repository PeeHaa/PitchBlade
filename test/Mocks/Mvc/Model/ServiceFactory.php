<?php
/**
 * This class builds services on demand
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Mvc
 * @subpackage Model
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBladeTest\Mocks\Mvc\Model;

use PitchBlade\Mvc\Model\ServiceBuilder;

/**
 * This class builds services on demand
 *
 * @category   PitchBlade
 * @package    Mvc
 * @subpackage Model
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class ServiceFactory implements ServiceBuilder
{
    /**
     * Create instance. The supplied namespace will also be normalized to make it cleaner to handle later.
     * After normalization the namespace will look like \Name\Space\Service\
     *
     * @param string $namespace The base namespace used to load services from. This is useful when unit testing to
     *                          easily be able to swap for mocked services
     */
    public function __construct()
    {
    }

    /**
     * Build and return an instance of the requested service
     *
     * @param string $service The service to load
     *
     * @return mixed The requested service object
     * @throws \PitchBlade\Mvc\Model\InvalidServiceException When trying to build an invalid service
     */
    public function build($service)
    {
    }
}
