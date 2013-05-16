<?php

namespace PitchBladeTest\Mvc\View;

use PitchBlade\Mvc\View\Factory,
    PitchBladeTest\Mocks\Mvc\Model\ServiceFactory,
    PitchBladeTest\Mocks\I18n\Translator;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Mvc\View\Factory::__construct
     */
    public function testConstructCorrectInterface()
    {
        $factory = new Factory(
            new ServiceFactory(),
            new Translator(),
            '',
            '\\PitchBladeTest\\Mocks\\Mvc\\View\\DummyView'
        );

        $this->assertInstanceOf('\\PitchBlade\\Mvc\\View\\Builder', $factory);
    }

    /**
     * @covers PitchBlade\Mvc\View\Factory::__construct
     * @covers PitchBlade\Mvc\View\Factory::build
     */
    public function testBuildWithPrependedSlashes()
    {
        $factory = new Factory(
            new ServiceFactory(),
            new Translator(),
            '',
            '\\PitchBladeTest\\Mocks\\Mvc\\View'
        );

        $this->assertInstanceOf('\\PitchBlade\\Mvc\\View\\Viewable', $factory->build('\\PitchBladeTest\\Mocks\\Mvc\\View\\DummyView'));
    }

    /**
     * @covers PitchBlade\Mvc\View\Factory::__construct
     * @covers PitchBlade\Mvc\View\Factory::build
     */
    public function testBuildWithoutPrependedSlashes()
    {
        $factory = new Factory(
            new ServiceFactory(),
            new Translator(),
            '',
            '\\PitchBladeTest\\Mocks\\Mvc\\View'
        );

        $this->assertInstanceOf('\\PitchBlade\\Mvc\\View\\Viewable', $factory->build('DummyView'));
    }

    /**
     * @covers PitchBlade\Mvc\View\Factory::__construct
     * @covers PitchBlade\Mvc\View\Factory::build
     */
    public function testBuildInvalidView()
    {
        $factory = new Factory(
            new ServiceFactory(),
            new Translator(),
            '',
            '\\PitchBladeTest\\Mocks\\Mvc\\View'
        );

        $this->setExpectedException('\\PitchBlade\\Mvc\\View\\InvalidViewException');

        $factory->build('InvalidView');
    }
}
