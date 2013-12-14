<?php

namespace PitchBladeTest\Unit\I18n\Language;

use PitchBlade\I18n\Language\CookieRecognizer;

class CookieRecognizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\I18n\Language\CookieRecognizer::__construct
     */
    public function testConstructCorrectInterface()
    {
        $recognizer = new CookieRecognizer(
            [],
            $this->getMock('\\PitchBlade\\Network\\Http\\RequestData')
        );

        $this->assertInstanceOf(
            '\\PitchBlade\\I18n\\Language\\Recognizer',
            $recognizer
        );
    }

    /**
     * @covers PitchBlade\I18n\Language\CookieRecognizer::__construct
     * @covers PitchBlade\I18n\Language\CookieRecognizer::getLanguage
     */
    public function testGetLanguageFoundLanguage()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->at(0))
            ->method('cookie')
            ->will($this->returnValue('nl'));
        $request->expects($this->at(1))
            ->method('cookie')
            ->will($this->returnValue('nl'));

        $recognizer = new CookieRecognizer(['nl'], $request);

        $this->assertSame('nl', $recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\CookieRecognizer::__construct
     * @covers PitchBlade\I18n\Language\CookieRecognizer::getLanguage
     */
    public function testGetLanguageUnsupportedLanguage()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->at(0))
            ->method('cookie')
            ->will($this->returnValue('en-US'));

        $recognizer = new CookieRecognizer(['nl'], $request);

        $this->assertNull($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\CookieRecognizer::__construct
     * @covers PitchBlade\I18n\Language\CookieRecognizer::getLanguage
     */
    public function testGetLanguageWithoutLanguages()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->at(0))
            ->method('cookie')
            ->will($this->returnValue('en-US'));

        $recognizer = new CookieRecognizer([], $request);

        $this->assertNull($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\CookieRecognizer::__construct
     * @covers PitchBlade\I18n\Language\CookieRecognizer::getLanguage
     */
    public function testGetLanguageWithoutValidLanguageHeader()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->at(0))
            ->method('cookie')
            ->will($this->returnValue('e'));

        $recognizer = new CookieRecognizer([], $request);

        $this->assertNull($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\CookieRecognizer::__construct
     * @covers PitchBlade\I18n\Language\CookieRecognizer::getLanguage
     */
    public function testGetLanguageWithoutLanguageHeader()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->at(0))
            ->method('cookie')
            ->will($this->returnValue(null));

        $recognizer = new CookieRecognizer([], $request);

        $this->assertNull($recognizer->getLanguage());
    }
}
