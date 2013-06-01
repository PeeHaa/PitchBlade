<?php

namespace PitchBladeTest\Mvc\Model;

use PitchBlade\Mvc\Model\ServiceFactory,
    PitchBladeTest\Mocks\Form\Field\Factory,
    PitchBladeTest\Mocks\Security\CsrfToken;

class ServiceFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Mvc\Model\ServiceFactory::__construct
     */
    public function testConstructCorrectInterface()
    {
        $factory = new ServiceFactory('\\Fake\\NameSpace', new Factory(), new CsrfToken());

        $this->assertInstanceOf('\\PitchBlade\\Mvc\\Model\\ServiceBuilder', $factory);
    }

    /**
     * @covers PitchBlade\Mvc\Model\ServiceFactory::__construct
     * @covers PitchBlade\Mvc\Model\ServiceFactory::buildInstance
     * @covers PitchBlade\Mvc\Model\ServiceFactory::build
     */
    public function testBuildNoCacheWithoutSlashes()
    {
        $factory = new ServiceFactory('PitchBladeTest\\Mocks\\Security\\Generator', new Factory(), new CsrfToken());

        $this->assertInstanceOf('\\PitchBlade\\Security\\Generator', $factory->build('Fake'));
    }

    /**
     * @covers PitchBlade\Mvc\Model\ServiceFactory::__construct
     * @covers PitchBlade\Mvc\Model\ServiceFactory::buildInstance
     * @covers PitchBlade\Mvc\Model\ServiceFactory::build
     */
    public function testBuildNoCacheWithSlashesWrapped()
    {
        $factory = new ServiceFactory('\\PitchBladeTest\\Mocks\\Security\\Generator\\', new Factory(), new CsrfToken());

        $this->assertInstanceOf('\\PitchBlade\\Security\\Generator', $factory->build('Fake'));
    }

    /**
     * @covers PitchBlade\Mvc\Model\ServiceFactory::__construct
     * @covers PitchBlade\Mvc\Model\ServiceFactory::buildInstance
     * @covers PitchBlade\Mvc\Model\ServiceFactory::build
     */
    public function testBuildNoCacheWithSlashesPrepend()
    {
        $factory = new ServiceFactory('\\PitchBladeTest\\Mocks\\Security\\Generator', new Factory(), new CsrfToken());

        $this->assertInstanceOf('\\PitchBlade\\Security\\Generator', $factory->build('Fake'));
    }

    /**
     * @covers PitchBlade\Mvc\Model\ServiceFactory::__construct
     * @covers PitchBlade\Mvc\Model\ServiceFactory::buildInstance
     * @covers PitchBlade\Mvc\Model\ServiceFactory::build
     */
    public function testBuildNoCacheWithSlashesTrailing()
    {
        $factory = new ServiceFactory('PitchBladeTest\\Mocks\\Security\\Generator\\', new Factory(), new CsrfToken());

        $this->assertInstanceOf('\\PitchBlade\\Security\\Generator', $factory->build('Fake'));
    }

    /**
     * @covers PitchBlade\Mvc\Model\ServiceFactory::__construct
     * @covers PitchBlade\Mvc\Model\ServiceFactory::buildInstance
     * @covers PitchBlade\Mvc\Model\ServiceFactory::build
     */
    public function testBuildCache()
    {
        $factory = new ServiceFactory('PitchBladeTest\\Mocks\\Security\\Generator', new Factory(), new CsrfToken());

        $this->assertInstanceOf('\\PitchBlade\\Security\\Generator', $factory->build('Fake'));
        $this->assertInstanceOf('\\PitchBlade\\Security\\Generator', $factory->build('Fake'));
    }

    /**
     * @covers PitchBlade\Mvc\Model\ServiceFactory::__construct
     * @covers PitchBlade\Mvc\Model\ServiceFactory::build
     */
    public function testBuildInvalidService()
    {
        $factory = new ServiceFactory('PitchBladeTest\\Mocks\\Security\\Generator', new Factory(), new CsrfToken());

        $this->setExpectedException('\\PitchBlade\\Mvc\\Model\\InvalidServiceException');

        $factory->build('InvalidClass');
    }

    /**
     * @covers PitchBlade\Mvc\Model\ServiceFactory::__construct
     * @covers PitchBlade\Mvc\Model\ServiceFactory::buildInstance
     * @covers PitchBlade\Mvc\Model\ServiceFactory::getClassConstructorArguments
     * @covers PitchBlade\Mvc\Model\ServiceFactory::build
     */
    public function testBuildServiceInvalidDependency()
    {
        $factory = new ServiceFactory('PitchBladeTest\\Mocks\\Mvc\\Model', new Factory(), new CsrfToken());

        $this->setExpectedException('\\PitchBlade\\Mvc\\Model\\InvalidParameterTypeException');

        $factory->build('InvalidType');
    }

    /**
     * @covers PitchBlade\Mvc\Model\ServiceFactory::__construct
     * @covers PitchBlade\Mvc\Model\ServiceFactory::buildInstance
     * @covers PitchBlade\Mvc\Model\ServiceFactory::getClassConstructorArguments
     * @covers PitchBlade\Mvc\Model\ServiceFactory::build
     */
    public function testBuildServiceWithCsrfDependency()
    {
        $factory = new ServiceFactory('PitchBladeTest\\Mocks\\Mvc\\Model', new Factory(), new CsrfToken());

        $this->assertInstanceOf('\\PitchBladeTest\\Mocks\\Mvc\\Model\\CsrfType', $factory->build('CsrfType'));
    }

    /**
     * @covers PitchBlade\Mvc\Model\ServiceFactory::__construct
     * @covers PitchBlade\Mvc\Model\ServiceFactory::buildInstance
     * @covers PitchBlade\Mvc\Model\ServiceFactory::getClassConstructorArguments
     * @covers PitchBlade\Mvc\Model\ServiceFactory::build
     */
    public function testBuildServiceWithFieldDependency()
    {
        $factory = new ServiceFactory('PitchBladeTest\\Mocks\\Mvc\\Model', new Factory(), new CsrfToken());

        $this->assertInstanceOf('\\PitchBladeTest\\Mocks\\Mvc\\Model\\FieldType', $factory->build('FieldType'));
    }

    /**
     * @covers PitchBlade\Mvc\Model\ServiceFactory::__construct
     * @covers PitchBlade\Mvc\Model\ServiceFactory::buildInstance
     * @covers PitchBlade\Mvc\Model\ServiceFactory::getClassConstructorArguments
     * @covers PitchBlade\Mvc\Model\ServiceFactory::build
     */
    public function testBuildServiceWithCsrfAndFieldDependency()
    {
        $factory = new ServiceFactory('PitchBladeTest\\Mocks\\Mvc\\Model', new Factory(), new CsrfToken());

        $this->assertInstanceOf('\\PitchBladeTest\\Mocks\\Mvc\\Model\\CsrfAndFieldType', $factory->build('CsrfAndFieldType'));
    }
}
