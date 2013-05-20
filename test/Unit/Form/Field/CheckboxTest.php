<?php

namespace PitchBladeTest\Unit\Form\Field;

use PitchBlade\Form\Field\Checkbox;

class CheckboxTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Form\Field\Checkbox::__construct
     */
    public function testConstructCorrectInstance()
    {
        $field = new Checkbox('checkboxField', ['label' => 'labelText']);

        $this->assertInstanceOf('\\PitchBlade\\Form\\Field\\Generic', $field);
    }

    /**
     * @covers PitchBlade\Form\Field\Checkbox::__construct
     * @covers PitchBlade\Form\Field\Checkbox::getLabel
     */
    public function testGetLabel()
    {
        $field = new Checkbox('checkboxField', ['label' => 'labelText']);

        $this->assertSame('labelText', $field->getLabel());
    }

    /**
     * @covers PitchBlade\Form\Field\Checkbox::__construct
     * @covers PitchBlade\Form\Field\Checkbox::getLabel
     */
    public function testGetLabelWithoutLabel()
    {
        $field = new Checkbox('checkboxField', []);

        $this->assertNull($field->getLabel());
    }
}
