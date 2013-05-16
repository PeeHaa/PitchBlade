<?php

namespace PitchBladeTest\Mvc\Model;

use PitchBlade\Mvc\Model\ServiceFactory;

class ServiceFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Mvc\Model\ServiceFactory::__construct
     */
    public function testConstructCorrectInterface()
    {
        $factory = new ServiceFactory('\\Fake\\NameSpace');

        $this->assertInstanceOf('\\PitchBlade\\Mvc\\Model\\ServiceBuilder', $factory);
    }

    /**
     * @covers PitchBlade\Mvc\Model\ServiceFactory::__construct
     * @covers PitchBlade\Mvc\Model\ServiceFactory::build
     */
    public function testBuildNoCacheWithoutSlashes()
    {
        $factory = new ServiceFactory('PitchBladeTest\\Mocks\\Security\\Generator');

        $this->assertInstanceOf('\\PitchBlade\\Security\\Generator', $factory->build('Fake'));
    }

    /**
     * @covers PitchBlade\Mvc\Model\ServiceFactory::__construct
     * @covers PitchBlade\Mvc\Model\ServiceFactory::build
     */
    public function testBuildNoCacheWithSlashesWrapped()
    {
        $factory = new ServiceFactory('\\PitchBladeTest\\Mocks\\Security\\Generator\\');

        $this->assertInstanceOf('\\PitchBlade\\Security\\Generator', $factory->build('Fake'));
    }

    /**
     * @covers PitchBlade\Mvc\Model\ServiceFactory::__construct
     * @covers PitchBlade\Mvc\Model\ServiceFactory::build
     */
    public function testBuildNoCacheWithSlashesPrepend()
    {
        $factory = new ServiceFactory('\\PitchBladeTest\\Mocks\\Security\\Generator');

        $this->assertInstanceOf('\\PitchBlade\\Security\\Generator', $factory->build('Fake'));
    }

    /**
     * @covers PitchBlade\Mvc\Model\ServiceFactory::__construct
     * @covers PitchBlade\Mvc\Model\ServiceFactory::build
     */
    public function testBuildNoCacheWithSlashesTrailing()
    {
        $factory = new ServiceFactory('PitchBladeTest\\Mocks\\Security\\Generator\\');

        $this->assertInstanceOf('\\PitchBlade\\Security\\Generator', $factory->build('Fake'));
    }

    /**
     * @covers PitchBlade\Mvc\Model\ServiceFactory::__construct
     * @covers PitchBlade\Mvc\Model\ServiceFactory::build
     */
    public function testBuildCache()
    {
        $factory = new ServiceFactory('PitchBladeTest\\Mocks\\Security\\Generator');

        $this->assertInstanceOf('\\PitchBlade\\Security\\Generator', $factory->build('Fake'));
        $this->assertInstanceOf('\\PitchBlade\\Security\\Generator', $factory->build('Fake'));
    }

    /**
     * @covers PitchBlade\Mvc\Model\ServiceFactory::__construct
     * @covers PitchBlade\Mvc\Model\ServiceFactory::build
     */
    public function testBuildInvalidService()
    {
        $factory = new ServiceFactory('PitchBladeTest\\Mocks\\Security\\Generator');

        $this->setExpectedException('\\PitchBlade\\Mvc\\Model\\InvalidServiceException');

        $factory->build('InvalidClass');
    }
}
