<?php
/**
 * Interface for service factories
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

/**
 * Interface for service factories
 *
 * @category   PitchBlade
 * @package    Mvc
 * @subpackage Model
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface ServiceBuilder
{
    /**
     * Build and return an instance of the requested service
     *
     * @param string $service The service to load
     *
     * @return mixed The requested service object
     */
    public function build($service);
}
