<?php

namespace PitchBladeTest\Unit\Form\Field;

use PitchBlade\Form\Field\Textarea;

class TextareaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Form\Field\Textarea::__construct
     */
    public function testConstructCorrectInstance()
    {
        $field = new Textarea('datetimeField', ['placeholder' => 'placeholder']);

        $this->assertInstanceOf('\\PitchBlade\\Form\\Field\\Generic', $field);
        $this->assertInstanceOf('\\PitchBlade\\Form\\Field\\Text', $field);
    }

    /**
     * @covers PitchBlade\Form\Field\Textarea::__construct
     */
    public function testConstructCorrectType()
    {
        $field = new Textarea('datetimeField', ['placeholder' => 'placeholder']);

        $this->assertSame('textarea', $field->getType());
    }
}
