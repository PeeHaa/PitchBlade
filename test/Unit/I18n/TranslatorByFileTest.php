<?php

namespace PitchBladeTest\Unit\I18n;

use PitchBlade\I18n\TranslatorByFile;

class TranslatorByFileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\I18n\TranslatorByFile::__construct
     */
    public function testGetInvalidFile()
    {
        $this->setExpectedException('\\PitchBlade\\I18n\\InvalidTranslationFileException');

        $translator = new TranslatorByFile(__DIR__ . '/../../Data', 'unk');
    }

    /**
     * @covers PitchBlade\I18n\TranslatorByFile::__construct
     * @covers PitchBlade\I18n\TranslatorByFile::get
     */
    public function testGetUndefinedKey()
    {
        $translator = new TranslatorByFile(__DIR__ . '/../../Data', 'eng');

        $this->assertSame('{{unknown}}', $translator->get('unknown'));
    }

    /**
     * @covers PitchBlade\I18n\TranslatorByFile::__construct
     * @covers PitchBlade\I18n\TranslatorByFile::get
     */
    public function testGetDefinedKey()
    {
        $translator = new TranslatorByFile(__DIR__ . '/../../Data', 'eng');

        $this->assertSame('known value', $translator->get('known.key'));
    }
}
