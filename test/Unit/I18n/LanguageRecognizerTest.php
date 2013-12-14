<?php

namespace PitchBladeTest\I18n;

use PitchBlade\I18n\LanguageRecognizer;

class LanguageRecognizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\I18n\LanguageRecognizer::__construct
     */
    public function testConstructCorrectInstanceWithoutCustomRecognizers()
    {
        $recognizer = new LanguageRecognizer(
            $this->getMock('\\PitchBlade\\I18n\\Language\\RecognizerBuilder')
        );

        $this->assertInstanceOf('\\PitchBlade\\I18n\\Language\\Recognizer', $recognizer);
    }

    /**
     * @covers PitchBlade\I18n\LanguageRecognizer::__construct
     */
    public function testConstructCorrectInstanceWithCustomRecognizers()
    {
        $recognizer = new LanguageRecognizer(
            $this->getMock('\\PitchBlade\\I18n\\Language\\RecognizerBuilder'),
            ['\\PitchBladeTest\\Mocks\\I18n\\Language\\SingleArg']
        );

        $this->assertInstanceOf('\\PitchBlade\\I18n\\Language\\Recognizer', $recognizer);
    }

    /**
     * @covers PitchBlade\I18n\LanguageRecognizer::__construct
     * @covers PitchBlade\I18n\LanguageRecognizer::getLanguage
     */
    public function testGetLanguageReturnNull()
    {
        $factory = $this->getMock('\\PitchBlade\\I18n\\Language\\RecognizerBuilder');
        $factory->expects($this->once())
            ->method('build')
            ->will($this->returnValue($this->getMock('\\PitchBlade\\I18n\\Language\\Recognizer')));

        $recognizer = new LanguageRecognizer(
            $factory,
            ['\\PitchBladeTest\\Mocks\\I18n\\Language\\ReturnsNull']
        );

        $this->assertNull($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\LanguageRecognizer::__construct
     * @covers PitchBlade\I18n\LanguageRecognizer::getLanguage
     */
    public function testGetLanguageReturnTrue()
    {
        $langRecognizer = $this->getMock('\\PitchBlade\\I18n\\Language\\Recognizer');
        $langRecognizer->expects($this->once())
            ->method('getLanguage')
            ->will($this->returnValue(true));

        $factory = $this->getMock('\\PitchBlade\\I18n\\Language\\RecognizerBuilder');
        $factory->expects($this->once())
            ->method('build')
            ->will($this->returnValue($langRecognizer));

        $recognizer = new LanguageRecognizer(
            $factory,
            ['\\PitchBladeTest\\Mocks\\I18n\\Language\\ReturnsTrue']
        );

        $this->assertTrue($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\LanguageRecognizer::__construct
     * @covers PitchBlade\I18n\LanguageRecognizer::getLanguage
     */
    public function testGetLanguageReturnTrueMultipleRecognizersHitFirst()
    {
        $langRecognizer = $this->getMock('\\PitchBlade\\I18n\\Language\\Recognizer');
        $langRecognizer->expects($this->once())
            ->method('getLanguage')
            ->will($this->returnValue(true));

        $factory = $this->getMock('\\PitchBlade\\I18n\\Language\\RecognizerBuilder');
        $factory->expects($this->once())
            ->method('build')
            ->will($this->returnValue($langRecognizer));

        $recognizer = new LanguageRecognizer(
            $factory,
            [
                '\\PitchBladeTest\\Mocks\\I18n\\Language\\ReturnsTrue',
                '\\PitchBladeTest\\Mocks\\I18n\\Language\\ReturnsNull',
            ]
        );

        $this->assertTrue($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\LanguageRecognizer::__construct
     * @covers PitchBlade\I18n\LanguageRecognizer::getLanguage
     */
    public function testGetLanguageReturnTrueMultipleRecognizersHitLast()
    {
        $factory = $this->getMock('\\PitchBlade\\I18n\\Language\\RecognizerBuilder');
        $factory->expects($this->at(0))
            ->method('build')
            ->will($this->returnCallback(function() {
                $langRecognizer = $this->getMock('\\PitchBlade\\I18n\\Language\\Recognizer');
                $langRecognizer->expects($this->at(0))
                    ->method('getLanguage')
                    ->will($this->returnValue(null));

                return $langRecognizer;
            }));
        $factory->expects($this->at(1))
            ->method('build')
            ->will($this->returnCallback(function() {
                $langRecognizer = $this->getMock('\\PitchBlade\\I18n\\Language\\Recognizer');
                $langRecognizer->expects($this->at(0))
                    ->method('getLanguage')
                    ->will($this->returnValue(true));

                return $langRecognizer;
            }));

        $recognizer = new LanguageRecognizer(
            $factory,
            [
                '\\PitchBladeTest\\Mocks\\I18n\\Language\\ReturnsNull',
                '\\PitchBladeTest\\Mocks\\I18n\\Language\\ReturnsTrue',
            ]
        );

        $this->assertTrue($recognizer->getLanguage());
    }
}
