<?php

namespace PitchBladeTest\Unit\Form\Field;

use PitchBlade\Form\Field\Select;

class SelectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Form\Field\Select::__construct
     */
    public function testConstructCorrectInstance()
    {
        $field = new Select('selectField', ['options' => []]);

        $this->assertInstanceOf('\\PitchBlade\\Form\\Field\\Generic', $field);
    }

    /**
     * @covers PitchBlade\Form\Field\Select::__construct
     */
    public function testConstructCorrectType()
    {
        $field = new Select('selectField', ['options' => []]);

        $this->assertSame('select', $field->getType());
    }
}
