<?php

namespace PitchBladeTest\Unit\Form\Field;

use PitchBlade\Form\Field\Datetime;

class DatetimeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Form\Field\Datetime::__construct
     */
    public function testConstructCorrectInstance()
    {
        $field = new Datetime('datetimeField', ['placeholder' => 'placeholder']);

        $this->assertInstanceOf('\\PitchBlade\\Form\\Field\\Generic', $field);
        $this->assertInstanceOf('\\PitchBlade\\Form\\Field\\Text', $field);
    }

    /**
     * @covers PitchBlade\Form\Field\Datetime::__construct
     */
    public function testConstructCorrectType()
    {
        $field = new Datetime('datetimeField', ['placeholder' => 'placeholder']);

        $this->assertSame('datetime', $field->getType());
    }
}
