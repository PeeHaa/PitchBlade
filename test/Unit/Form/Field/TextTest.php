<?php

namespace PitchBladeTest\Unit\Form\Field;

use PitchBlade\Form\Field\Text;

class TextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Form\Field\Text::__construct
     */
    public function testConstructCorrectInstance()
    {
        $field = new Text('textField', ['placeholder' => 'placeholder']);

        $this->assertInstanceOf('\\PitchBlade\\Form\\Field\\Generic', $field);
    }

    /**
     * @covers PitchBlade\Form\Field\Text::__construct
     * @covers PitchBlade\Form\Field\Text::getPlaceholder
     */
    public function testGetPlaceholder()
    {
        $field = new Text('textField', ['placeholder' => 'placeholderText']);

        $this->assertSame('placeholderText', $field->getPlaceHolder());
    }

    /**
     * @covers PitchBlade\Form\Field\Text::__construct
     * @covers PitchBlade\Form\Field\Text::getPlaceholder
     */
    public function testGetPlaceholderWithoutPlaceholder()
    {
        $field = new Text('textField', []);

        $this->assertNull($field->getPlaceHolder());
    }
}
