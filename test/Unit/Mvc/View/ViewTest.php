<?php

namespace PitchBladeTest\Mvc\View;

use PitchBlade\Mvc\View,
    PitchBladeTest\Mocks\Mvc\View\DummyView,
    PitchBladeTest\Mocks\Mvc\View\Factory as ViewFactory,
    PitchBladeTest\Mocks\Mvc\Model\ServiceFactory,
    PitchBladeTest\Mocks\I18n\Translator;
    /*
    PitchBlade\Mvc\View\InvalidTemplateException;
    */

class ViewTest extends \PHPUnit_Framework_TestCase
{
    protected $constructorParams;

    protected function setUp()
    {
        $this->constructorParams = [
            new Viewfactory(),
            new ServiceFactory(),
            new Translator(),
            __DIR__ . '/../../../Data/Templates/base.phtml',
            'en',
        ];
    }

    /**
     * @covers PitchBlade\Mvc\View\View::__construct
     */
    public function testConstructValid()
    {
        $view = $this->getMockForAbstractClass('\\PitchBlade\\Mvc\\View\\View', $this->constructorParams);

        $this->assertInstanceOf('\\PitchBlade\\Mvc\\View\\View', $view);
    }

    /**
     * @covers PitchBlade\Mvc\View\View::__construct
     */
    public function testConstructInvalidBaseTemplate()
    {
        $this->setExpectedException('\\PitchBlade\\Mvc\\View\\InvalidBaseTemplateException');

        $this->constructorParams[3] = __DIR__ . '/../../../Data/Templates/unknown-template.phtml';

        $view = $this->getMockForAbstractClass('\\PitchBlade\\Mvc\\View\\View', $this->constructorParams);
    }

    /**
     * @covers PitchBlade\Mvc\View\View::__construct
     * @covers PitchBlade\Mvc\View\View::__set
     */
    public function testSet()
    {
        $view = $this->getMockForAbstractClass('\\PitchBlade\\Mvc\\View\\View', $this->constructorParams);

        $view->viewVariable = 'something';
    }

    /**
     * @covers PitchBlade\Mvc\View\View::__construct
     * @covers PitchBlade\Mvc\View\View::__isset
     */
    public function testIssetNotSet()
    {
        $view = $this->getMockForAbstractClass('\\PitchBlade\\Mvc\\View\\View', $this->constructorParams);

        $this->assertFalse(isset($view->undefinedVariable));
    }

    /**
     * @covers PitchBlade\Mvc\View\View::__construct
     * @covers PitchBlade\Mvc\View\View::__set
     * @covers PitchBlade\Mvc\View\View::__isset
     */
    public function testIssetSet()
    {
        $view = $this->getMockForAbstractClass('\\PitchBlade\\Mvc\\View\\View', $this->constructorParams);

        $view->definedVariable = 'something';

        $this->assertTrue(isset($view->definedVariable));
    }

    /**
     * @covers PitchBlade\Mvc\View\View::__construct
     * @covers PitchBlade\Mvc\View\View::__set
     * @covers PitchBlade\Mvc\View\View::__get
     */
    public function testGetValid()
    {
        $view = $this->getMockForAbstractClass('\\PitchBlade\\Mvc\\View\\View', $this->constructorParams);

        $view->definedVariable = 'something';

        $this->assertSame('something', $view->definedVariable);
    }

    /**
     * @covers PitchBlade\Mvc\View\View::__construct
     * @covers PitchBlade\Mvc\View\View::__get
     */
    public function testGetInvalid()
    {
        $view = $this->getMockForAbstractClass('\\PitchBlade\\Mvc\\View\\View', $this->constructorParams);

        $this->setExpectedException('\\PitchBlade\\Mvc\\View\\UndefinedVariableException');

        $view->undefinedVariable;
    }

    /**
     * @covers PitchBlade\Mvc\View\View::__construct
     * @covers PitchBlade\Mvc\View\View::render
     */
    public function testRenderSuccess()
    {
        $view = new DummyView(
            new Viewfactory(),
            new ServiceFactory(),
            new Translator(),
            __DIR__ . '/../../../Data/Templates/base.phtml',
            'en'
        );

        $this->assertSame('TESTCONTENT', $view->renderMock(__DIR__ . '/../../../Data/Templates/content.phtml'));
    }

    /**
     * @covers PitchBlade\Mvc\View\View::__construct
     * @covers PitchBlade\Mvc\View\View::render
     */
    public function testRenderInvalidTemplate()
    {
        $view = new DummyView(
            new Viewfactory(),
            new ServiceFactory(),
            new Translator(),
            __DIR__ . '/../../../Data/Templates/base.phtml',
            'en'
        );

        $this->setExpectedException('\\PitchBlade\\Mvc\\View\\InvalidTemplateException');

        $view->renderMock(__DIR__ . '/../../../Data/Templates/unknown-template.phtml');
    }

    /**
     * @covers PitchBlade\Mvc\View\View::__construct
     * @covers PitchBlade\Mvc\View\View::render
     * @covers PitchBlade\Mvc\View\View::renderPage
     * @covers PitchBlade\Mvc\View\View::__set
     * @covers PitchBlade\Mvc\View\View::__get
     */

    public function testRenderPageSuccess()
    {
        $view = new DummyView(
            new Viewfactory(),
            new ServiceFactory(),
            new Translator(),
            __DIR__ . '/../../../Data/Templates/base.phtml',
            'en'
        );

        $this->assertSame('TESTBASETESTCONTENT', $view->renderPageMock(__DIR__ . '/../../../Data/Templates/content.phtml'));
    }

    /**
     * @covers PitchBlade\Mvc\View\View::__construct
     * @covers PitchBlade\Mvc\View\View::render
     * @covers PitchBlade\Mvc\View\View::renderPage
     * @covers PitchBlade\Mvc\View\View::__set
     * @covers PitchBlade\Mvc\View\View::__get
     */
    public function testRenderPageInvalidTemplate()
    {
        $view = new DummyView(
            new Viewfactory(),
            new ServiceFactory(),
            new Translator(),
            __DIR__ . '/../../../Data/Templates/base.phtml',
            'en'
        );

        $this->setExpectedException('\\PitchBlade\\Mvc\\View\\InvalidTemplateException');

        $view->renderPageMock(__DIR__ . '/../../../Data/Templates/unknown-template.phtml');
    }

    /**
     * @covers PitchBlade\Mvc\View\View::__construct
     * @covers PitchBlade\Mvc\View\View::render
     * @covers PitchBlade\Mvc\View\View::renderPage
     * @covers PitchBlade\Mvc\View\View::__set
     * @covers PitchBlade\Mvc\View\View::__get
     * @covers PitchBlade\Mvc\View\View::renderView
     */
    public function testRenderViewWithoutData()
    {
        $view = new DummyView(
            new \PitchBlade\Mvc\View\Factory(
                new ServiceFactory(),
                new Translator(),
                __DIR__ . '/../../../Data/Templates/base.phtml',
                'en',
                '\\PitchBladeTest\\Mocks\\Mvc\\View'
            ),
            new ServiceFactory(),
            new Translator(),
            __DIR__ . '/../../../Data/Templates/base.phtml',
            'en'
        );

        $this->assertSame(
            'TESTBASETESTWITHPARTIALPARTIAL',
            $view->renderPageMock(__DIR__ . '/../../../Data/Templates/content-with-partial-without-data.phtml')
        );
    }

    /**
     * @covers PitchBlade\Mvc\View\View::__construct
     * @covers PitchBlade\Mvc\View\View::render
     * @covers PitchBlade\Mvc\View\View::renderPage
     * @covers PitchBlade\Mvc\View\View::__set
     * @covers PitchBlade\Mvc\View\View::__get
     * @covers PitchBlade\Mvc\View\View::renderView
     */
    public function testRenderViewWithData()
    {
        $view = new DummyView(
            new \PitchBlade\Mvc\View\Factory(
                new ServiceFactory(),
                new Translator(),
                __DIR__ . '/../../../Data/Templates/base.phtml',
                'en',
                '\\PitchBladeTest\\Mocks\\Mvc\\View'
            ),
            new ServiceFactory(),
            new Translator(),
            __DIR__ . '/../../../Data/Templates/base.phtml',
            'en'
        );

        $this->assertSame(
            'TESTBASETESTWITHPARTIALPARTIALWITHDATA',
            $view->renderPageMock(__DIR__ . '/../../../Data/Templates/content-with-partial-with-data.phtml')
        );
    }

    /**
     * @covers PitchBlade\Mvc\View\View::__construct
     * @covers PitchBlade\Mvc\View\View::render
     * @covers PitchBlade\Mvc\View\View::renderPage
     * @covers PitchBlade\Mvc\View\View::__set
     * @covers PitchBlade\Mvc\View\View::__get
     */
    public function testTranslate()
    {
        $view = new DummyView(
            new Viewfactory(),
            new ServiceFactory(),
            new Translator(),
            __DIR__ . '/../../../Data/Templates/base.phtml',
            'en'
        );

        $this->assertSame(
            'TESTBASETRANSLATION',
            $view->renderPageMock(__DIR__ . '/../../../Data/Templates/content-with-translation.phtml')
        );
    }
}
