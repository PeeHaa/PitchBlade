<?php

namespace PitchBladeTest\Unit\I18n\Language;

use PitchBlade\I18n\Language\BrowserRecognizer,
    PitchBladeTest\Mocks\Http\Request;

class BrowserRecognizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::__construct
     */
    public function testConstructCorrectInterface()
    {
        $recognizer = new BrowserRecognizer([], new Request([]));

        $this->assertInstanceOf('\\PitchBlade\\I18n\\Language\\Recognizer', $recognizer);
    }

    /**
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::__construct
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::getLanguage
     */
    public function testGetLanguageFoundLanguage()
    {
        $recognizer = new BrowserRecognizer(['nl'], new Request(['serverVariables'=>['HTTP_ACCEPT_LANGUAGE' => 'nl-NL']]));

        $this->assertSame('nl', $recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::__construct
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::getLanguage
     */
    public function testGetLanguageUnsupportedLanguage()
    {
        $recognizer = new BrowserRecognizer(['nl'], new Request(['serverVariables'=>['HTTP_ACCEPT_LANGUAGE' => 'en-US']]));

        $this->assertNull($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::__construct
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::getLanguage
     */
    public function testGetLanguageWithoutLanguages()
    {
        $recognizer = new BrowserRecognizer([], new Request(['serverVariables'=>['HTTP_ACCEPT_LANGUAGE' => 'en-US']]));

        $this->assertNull($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::__construct
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::getLanguage
     */
    public function testGetLanguageWithoutValidLanguageHeader()
    {
        $recognizer = new BrowserRecognizer([], new Request(['serverVariables'=>['HTTP_ACCEPT_LANGUAGE' => 'e']]));

        $this->assertNull($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::__construct
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::getLanguage
     */
    public function testGetLanguageWithoutLanguageHeader()
    {
        $recognizer = new BrowserRecognizer([], new Request(['serverVariables'=>[]]));

        $this->assertNull($recognizer->getLanguage());
    }
}
