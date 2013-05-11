<?php

namespace PitchBladeTest\I18n\Language;

use PitchBlade\I18n\Language\DefaultRecognizer;

class DefaultRecognizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\I18n\Language\DefaultRecognizer::__construct
     */
    public function testConstructCorrectInterface()
    {
        $recognizer = new DefaultRecognizer([]);

        $this->assertInstanceOf('\\PitchBlade\\I18n\\Language\\Recognizer', $recognizer);
    }

    /**
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::__construct
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::getLanguage
     */
    public function testGetLanguageFoundLanguage()
    {
        $recognizer = new DefaultRecognizer(['nl']);

        $this->assertSame('nl', $recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::__construct
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::getLanguage
     */
    public function testGetLanguageFoundLanguageWithMutlipleLanguages()
    {
        $recognizer = new DefaultRecognizer(['nl', 'en']);

        $this->assertSame('nl', $recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::__construct
     * @covers PitchBlade\I18n\Language\BrowserRecognizer::getLanguage
     */
    public function testGetLanguageWithoutLanguages()
    {
        $recognizer = new DefaultRecognizer([]);

        $this->assertNull($recognizer->getLanguage());
    }
}
