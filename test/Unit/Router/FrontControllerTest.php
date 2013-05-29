<?php

namespace PitchBladeTest\Unit\Router;

use PitchBlade\Router\FrontController,
    PitchBladeTest\Mocks\Http\Request,
    PitchBladeTest\Mocks\Router\Routes,
    PitchBladeTest\Mocks\Mvc\View\Factory as ViewFactory,
    PitchBladeTest\Mocks\Form\Field\Factory as FieldFactory,
    PitchBladeTest\Mocks\Security\CsrfToken;

class FrontControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\FrontController::__construct
     */
    public function testConstructCorrectInterface()
    {
        $frontController = new FrontController(
            new Request([]),
            new Routes(),
            new ViewFactory(),
            new FieldFactory(),
            new CsrfToken()
        );

        $this->assertInstanceOf('\\PitchBlade\\Router\\FrontController', $frontController);
    }

    /**
     * @covers PitchBlade\Router\FrontController::__construct
     * @covers PitchBlade\Router\FrontController::dispatch
     */
    public function testConstructCorrectInterfaceWithoutDefaultsWithoutDependencies()
    {
        $frontController = new FrontController(
            new Request([]),
            new \PitchBladeTest\Mocks\Router\RoutesWithoutDefaultsOrDependencies(),
            new ViewFactory(),
            new FieldFactory(),
            new CsrfToken()
        );

        $this->assertSame('TESTRESPONSE', $frontController->dispatch());
    }

    /**
     * @covers PitchBlade\Router\FrontController::__construct
     * @covers PitchBlade\Router\FrontController::dispatch
     */
    public function testConstructCorrectInterfaceWithDefaultsWithoutDependencies()
    {
        $frontController = new FrontController(
            new Request([]),
            new \PitchBladeTest\Mocks\Router\RoutesWithDefaultsWithoutDependencies(),
            new ViewFactory(),
            new FieldFactory(),
            new CsrfToken()
        );

        $this->assertSame('TESTRESPONSE', $frontController->dispatch());
    }

    /**
     * @covers PitchBlade\Router\FrontController::__construct
     * @covers PitchBlade\Router\FrontController::dispatch
     */
    public function testConstructCorrectInterfaceWithoutDefaultsWithDependencies()
    {
        $frontController = new FrontController(
            new Request([]),
            new \PitchBladeTest\Mocks\Router\RoutesWithoutDefaultsWithDependencies(),
            new ViewFactory(),
            new FieldFactory(),
            new CsrfToken()
        );

        $this->assertSame('TESTRESPONSEDEPENDENCY', $frontController->dispatch());
    }
}
