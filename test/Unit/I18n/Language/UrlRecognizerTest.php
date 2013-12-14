<?php

namespace PitchBladeTest\I18n\Language;

use PitchBlade\I18n\Language\UrlRecognizer;

class UrlRecognizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\I18n\Language\UrlRecognizer::__construct
     */
    public function testConstructCorrectInterface()
    {
        $recognizer = new UrlRecognizer([], $this->getMock('\\PitchBlade\\Network\\Http\\RequestData'));

        $this->assertInstanceOf('\\PitchBlade\\I18n\\Language\\Recognizer', $recognizer);
    }

    /**
     * @covers PitchBlade\I18n\Language\UrlRecognizer::__construct
     * @covers PitchBlade\I18n\Language\UrlRecognizer::getLanguage
     */
    public function testGetLanguageFoundLanguage()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->at(0))
            ->method('path')
            ->will($this->returnValue('nl'));
        $request->expects($this->at(1))
            ->method('path')
            ->will($this->returnValue('nl'));

        $recognizer = new UrlRecognizer(['nl'], $request);

        $this->assertSame('nl', $recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\UrlRecognizer::__construct
     * @covers PitchBlade\I18n\Language\UrlRecognizer::getLanguage
     */
    public function testGetLanguageUnsupportedLanguage()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('path')
            ->will($this->returnValue('en'));

        $recognizer = new UrlRecognizer(['nl'], $request);

        $this->assertNull($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\UrlRecognizer::__construct
     * @covers PitchBlade\I18n\Language\UrlRecognizer::getLanguage
     */
    public function testGetLanguageWithoutLanguages()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('path')
            ->will($this->returnValue('en'));

        $recognizer = new UrlRecognizer([], $request);

        $this->assertNull($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\UrlRecognizer::__construct
     * @covers PitchBlade\I18n\Language\UrlRecognizer::getLanguage
     */
    public function testGetLanguageWithoutValidLanguageHeader()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('path')
            ->will($this->returnValue('e'));

        $recognizer = new UrlRecognizer([], $request);

        $this->assertNull($recognizer->getLanguage());
    }

    /**
     * @covers PitchBlade\I18n\Language\UrlRecognizer::__construct
     * @covers PitchBlade\I18n\Language\UrlRecognizer::getLanguage
     */
    public function testGetLanguageWithoutLanguageHeader()
    {
        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('path')
            ->will($this->returnValue(null));

        $recognizer = new UrlRecognizer([], $request);

        $this->assertNull($recognizer->getLanguage());
    }
}
