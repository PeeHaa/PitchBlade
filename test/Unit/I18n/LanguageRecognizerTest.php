<?php

namespace PitchBladeTest\I18n;

use PitchBlade\I18n\LanguageRecognizer,
    PitchBladeTest\Mocks\I18n\Language\RecognizerFactory;

class LanguageRecognizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\I18n\LanguageRecognizer::__construct
     */
    public function testConstructCorrectInstanceWithoutCustomRecognizers()
    {
        $recognizer = new LanguageRecognizer(new RecognizerFactory());

        $this->assertInstanceOf('\\PitchBlade\\I18n\\Language\\Recognizer', $recognizer);
    }

    /**
     * @covers PitchBlade\I18n\LanguageRecognizer::__construct
     */
    public function testConstructCorrectInstanceWithCustomRecognizers()
    {
        $recognizer = new LanguageRecognizer(
            new RecognizerFactory(),
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
        $recognizer = new LanguageRecognizer(
            new RecognizerFactory(),
            ['\\PitchBladeTest\\Mocks\\I18n\\Language\\SingleArgNull']
        );

        $this->assertNull($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\LanguageRecognizer::__construct
     * @covers PitchBlade\I18n\LanguageRecognizer::getLanguage
     */
    public function testGetLanguageReturnTrue()
    {
        $recognizer = new LanguageRecognizer(
            new RecognizerFactory(),
            ['\\PitchBladeTest\\Mocks\\I18n\\Language\\SingleArgTrue']
        );

        $this->assertTrue($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\LanguageRecognizer::__construct
     * @covers PitchBlade\I18n\LanguageRecognizer::getLanguage
     */
    public function testGetLanguageReturnTrueMultipleRecognizersHitFirst()
    {
        $recognizer = new LanguageRecognizer(
            new RecognizerFactory(),
            ['\\PitchBladeTest\\Mocks\\I18n\\Language\\SingleArgTrue', '\\PitchBladeTest\\Mocks\\I18n\\Language\\SingleArgNull']
        );

        $this->assertTrue($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\LanguageRecognizer::__construct
     * @covers PitchBlade\I18n\LanguageRecognizer::getLanguage
     */
    public function testGetLanguageReturnTrueMultipleRecognizersHitLast()
    {
        $recognizer = new LanguageRecognizer(
            new RecognizerFactory(),
            ['\\PitchBladeTest\\Mocks\\I18n\\Language\\SingleArgNull', '\\PitchBladeTest\\Mocks\\I18n\\Language\\SingleArgTrue']
        );

        $this->assertTrue($recognizer->getLanguage());
    }
}
