<?php

namespace PitchBladeTest\I18n\Language;

use PitchBlade\I18n\Language\RecognizerFactory;

class RecognizerFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\I18n\Language\RecognizerFactory::__construct
     */
    public function testConstructCorrectInterface()
    {
        $factory = new RecognizerFactory([], $this->getMock('\\PitchBlade\\Network\\Http\\RequestData'));

        $this->assertInstanceOf('\\PitchBlade\\I18n\\Language\\RecognizerBuilder', $factory);
    }

    /**
     * @covers PitchBlade\I18n\Language\RecognizerFactory::__construct
     * @covers PitchBlade\I18n\Language\RecognizerFactory::build
     */
    public function testBuildRecognizerWithSingleArgument()
    {
        $factory = new RecognizerFactory(['nl'], $this->getMock('\\PitchBlade\\Network\\Http\\RequestData'));

        $recognizer = $factory->build('\\PitchBladeTest\\Mocks\\I18n\\Language\\SingleArg');

        $this->assertInstanceOf('\\PitchBlade\\I18n\\Language\\Recognizer', $recognizer);
        $this->assertSame(['nl'], $recognizer->getSupportedLanguages());
    }

    /**
     * @covers PitchBlade\I18n\Language\RecognizerFactory::__construct
     * @covers PitchBlade\I18n\Language\RecognizerFactory::build
     * @covers PitchBlade\I18n\Language\RecognizerFactory::buildClassConstructorArguments
     */
    public function testBuildRecognizerWithTwoArguments()
    {
        $factory = new RecognizerFactory(['nl'], $this->getMock('\\PitchBlade\\Network\\Http\\RequestData'));

        $recognizer = $factory->build('\\PitchBladeTest\\Mocks\\I18n\\Language\\TwoArg');

        $this->assertInstanceOf('\\PitchBlade\\I18n\\Language\\Recognizer', $recognizer);
        $this->assertSame(['nl'], $recognizer->getSupportedLanguages());
    }

    /**
     * @covers PitchBlade\I18n\Language\RecognizerFactory::__construct
     * @covers PitchBlade\I18n\Language\RecognizerFactory::build
     */
    public function testBuildRecognizerInvalidRecognizer()
    {
        $factory = new RecognizerFactory(['nl'], $this->getMock('\\PitchBlade\\Network\\Http\\RequestData'));

        $this->setExpectedException('\\PitchBlade\\I18n\\Language\\InvalidRecognizerException');

        $recognizer = $factory->build('\\PitchBladeTest\\Mocks\\I18n\\Language\\InvalidRecognizer');
    }

    /**
     * @covers PitchBlade\I18n\Language\RecognizerFactory::__construct
     * @covers PitchBlade\I18n\Language\RecognizerFactory::build
     */
    public function testBuildRecognizerInvalidParameterNumber()
    {
        $factory = new RecognizerFactory(['nl'], $this->getMock('\\PitchBlade\\Network\\Http\\RequestData'));

        $this->setExpectedException('\\PitchBlade\\I18n\\Language\\InvalidParameterNumberException');

        $recognizer = $factory->build('\\PitchBladeTest\\Mocks\\I18n\\Language\\ThreeArg');
    }

    /**
     * @covers PitchBlade\I18n\Language\RecognizerFactory::__construct
     * @covers PitchBlade\I18n\Language\RecognizerFactory::build
     * @covers PitchBlade\I18n\Language\RecognizerFactory::buildClassConstructorArguments
     */
    public function testBuildRecognizerInvalidParameterType()
    {
        $factory = new RecognizerFactory(['nl'], $this->getMock('\\PitchBlade\\Network\\Http\\RequestData'));

        $this->setExpectedException('\\PitchBlade\\I18n\\Language\\InvalidParameterTypeException');

        $recognizer = $factory->build('\\PitchBladeTest\\Mocks\\I18n\\Language\\TwoArgInvalidType');
    }
}
