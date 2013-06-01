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
    PitchBlade\Form\Field\Builder as FieldBuilder,
    PitchBlade\Security\TokenGenerator,
    PitchBlade\Mvc\Model\InvalidServiceException,
    PitchBlade\Mvc\Model\InvalidParameterTypeException;

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
     * @var \PitchBlade\Form\Field\Builder A form field factory
     */
    private $fieldFactory;

    /**
     * @var \PitchBlade\Security\TokenGenerator An CSRF token generator
     */
    private $csrfToken;

    /**
     * @var array List of already loaded services so that we do not have to create a new instance each time
     */
    private $cache = [];

    /**
     * Create instance. The supplied namespace will also be normalized to make it cleaner to handle later.
     * After normalization the namespace will look like \Name\Space\Service\
     *
     * @param string                              $namespace    The base namespace used to load services from. This is
     *                                                          useful when unit testing to easily be able to swap for
     *                                                          mocked services
     * @param \PitchBlade\Form\Field\Builder      $fieldFactory The field factory
     * @param \PitchBlade\Security\TokenGenerator $csrfToken    The csrf token
     */
    public function __construct($namespace, FieldBuilder $fieldFactory, TokenGenerator $csrfToken)
    {
        $this->namespace    = '\\' . trim($namespace, '\\') . '\\';
        $this->fieldFactory = $fieldFactory;
        $this->csrfToken    = $csrfToken;
    }

    /**
     * Build and return an instance of the requested service
     *
     * @param string $service The service to load
     *
     * @return object The requested service object
     * @throws \PitchBlade\Mvc\Model\InvalidServiceException When trying to build an invalid service
     */
    public function build($service)
    {
        if (!array_key_exists($service, $this->cache)) {
            $serviceClass = $this->namespace . $service;

            if (!class_exists($serviceClass)) {
                throw new InvalidServiceException('Invalid service (`' . $serviceClass . '`).');
            }

            $this->cache[$service] = $this->buildInstance($serviceClass);
        }

        return $this->cache[$service];
    }

    /**
     * Builds the instance of the service based on the constructor arguments
     *
     * @param string The class we need an instance of
     *
     * @return object Instance of the service
     */
    private function buildInstance($serviceClass)
    {
        $reflectedService = new \ReflectionClass($serviceClass);
        $constructor = $reflectedService->getConstructor();

        if ($constructor === null || $constructor->getNumberOfParameters() === 0) {
            return new $serviceClass();
        }

        return $reflectedService->newInstanceArgs($this->getClassConstructorArguments($constructor));
    }

    /**
     * Builds the constructor arguments for the service
     *
     * @param \ReflectionMethod $constructor The constructor
     *
     * @return array The arguments for the constructor
     * @throws \PitchBlade\Mvc\Model\InvalidParameterTypeException When constructor expects an invalid parameter type
     */
    private function getClassConstructorArguments(\ReflectionMethod $constructor)
    {
        $arguments = [];
        foreach ($constructor->getParameters() as $parameter) {
            switch ($parameter->getClass()->name) {
                case 'PitchBlade\\Form\\Field\\Builder':
                    $arguments[] = $this->fieldFactory;
                    break;

                case 'PitchBlade\\Security\\TokenGenerator':
                    $arguments[] = $this->csrfToken;
                    break;

                default:
                    throw new InvalidParameterTypeException(
                        'Invalid parameter type (`' . $parameter->getClass()->name . '`) found in constructor of class (`' . $constructor->class . '`).'
                    );
                    break;
            }
        }

        return $arguments;
    }
}
