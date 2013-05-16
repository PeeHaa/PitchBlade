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
namespace PitchBlade\Mvc\Model;

use PitchBlade\Mvc\Model\ServiceBuilder,
    PitchBlade\Mvc\Model\InvalidServiceException;

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
     * @var string The base namespace used to load services from
     */
    private $namespace;

    /**
     * @var array List of already loaded services so that we do not have to create a new instance each time
     */
    private $cache = [];

    /**
     * Create instance. The supplied namespace will also be normalized to make it cleaner to handle later.
     * After normalization the namespace will look like \Name\Space\Service\
     *
     * @param string $namespace The base namespace used to load services from. This is useful when unit testing to
     *                          easily be able to swap for mocked services
     */
    public function __construct($namespace)
    {
        $this->namespace = '\\' . trim($namespace, '\\') . '\\';
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
        if (!array_key_exists($service, $this->cache)) {
            $serviceClass = $this->namespace . $service;

            if (!class_exists($serviceClass)) {
                throw new InvalidServiceException('Invalid service (`' . $serviceClass . '`).');
            }

            $this->cache[$service] = new $serviceClass();
        }

        return $this->cache[$service];
    }
}
