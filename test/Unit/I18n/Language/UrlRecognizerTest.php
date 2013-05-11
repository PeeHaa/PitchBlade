<?php

namespace PitchBladeTest\I18n\Language;

use PitchBlade\I18n\Language\UrlRecognizer,
    PitchBladeTest\Mocks\Http\Request;

class UrlRecognizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\I18n\Language\UrlRecognizer::__construct
     */
    public function testConstructCorrectInterface()
    {
        $recognizer = new UrlRecognizer([], new Request([]));

        $this->assertInstanceOf('\\PitchBlade\\I18n\\Language\\Recognizer', $recognizer);
    }

    /**
     * @covers PitchBlade\I18n\Language\UrlRecognizer::__construct
     * @covers PitchBlade\I18n\Language\UrlRecognizer::getLanguage
     */
    public function testGetLanguageFoundLanguage()
    {
        $recognizer = new UrlRecognizer(['nl'], new Request(['pathVariables'=>['language' => 'nl']]));

        $this->assertSame('nl', $recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\UrlRecognizer::__construct
     * @covers PitchBlade\I18n\Language\UrlRecognizer::getLanguage
     */
    public function testGetLanguageUnsupportedLanguage()
    {
        $recognizer = new UrlRecognizer(['nl'], new Request(['pathVariables'=>['language' => 'en']]));

        $this->assertNull($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\UrlRecognizer::__construct
     * @covers PitchBlade\I18n\Language\UrlRecognizer::getLanguage
     */
    public function testGetLanguageWithoutLanguages()
    {
        $recognizer = new UrlRecognizer([], new Request(['pathVariables'=>['language' => 'en']]));

        $this->assertNull($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\UrlRecognizer::__construct
     * @covers PitchBlade\I18n\Language\UrlRecognizer::getLanguage
     */
    public function testGetLanguageWithoutValidLanguageHeader()
    {
        $recognizer = new UrlRecognizer([], new Request(['pathVariables'=>['language' => 'e']]));

        $this->assertNull($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\UrlRecognizer::__construct
     * @covers PitchBlade\I18n\Language\UrlRecognizer::getLanguage
     */
    public function testGetLanguageWithoutLanguageHeader()
    {
        $recognizer = new UrlRecognizer([], new Request(['pathVariables'=>[]]));

        $this->assertNull($recognizer->getLanguage());
    }
}
