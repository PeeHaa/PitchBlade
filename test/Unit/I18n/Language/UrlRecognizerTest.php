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
        $recognizer = new BrowserRecognizer([], new Request([]));

        $this->assertInstanceOf('\\PitchBlade\\I18n\\Language\\Recognizer', $recognizer);
    }

    /**
     * @covers PitchBlade\I18n\Language\UrlRecognizer::__construct
     * @covers PitchBlade\I18n\Language\UrlRecognizer::getLanguage
     */
    public function testGetLanguageFoundLanguage()
    {
        $recognizer = new BrowserRecognizer(['nl'], new Request(['pathVariables'=>['language' => 'nl-NL']]));

        $this->assertSame('nl', $recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\UrlRecognizer::__construct
     * @covers PitchBlade\I18n\Language\UrlRecognizer::getLanguage
     */
    public function testGetLanguageUnsupportedLanguage()
    {
        $recognizer = new BrowserRecognizer(['nl'], new Request(['pathVariables'=>['language' => 'en-US']]));

        $this->assertNull($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\UrlRecognizer::__construct
     * @covers PitchBlade\I18n\Language\UrlRecognizer::getLanguage
     */
    public function testGetLanguageWithoutLanguages()
    {
        $recognizer = new BrowserRecognizer([], new Request(['pathVariables'=>['language' => 'en-US']]));

        $this->assertNull($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\UrlRecognizer::__construct
     * @covers PitchBlade\I18n\Language\UrlRecognizer::getLanguage
     */
    public function testGetLanguageWithoutValidLanguageHeader()
    {
        $recognizer = new BrowserRecognizer([], new Request(['pathVariables'=>['language' => 'e']]));

        $this->assertNull($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\UrlRecognizer::__construct
     * @covers PitchBlade\I18n\Language\UrlRecognizer::getLanguage
     */
    public function testGetLanguageWithoutLanguageHeader()
    {
        $recognizer = new BrowserRecognizer([], new Request(['serverVariables'=>[]]));

        $this->assertNull($recognizer->getLanguage());
    }
}
