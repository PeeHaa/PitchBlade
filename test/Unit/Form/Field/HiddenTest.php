<?php

namespace PitchBladeTest\Unit\Form\Field;

use PitchBlade\Form\Field\Hidden;

class HiddenTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Form\Field\Hidden::__construct
     */
    public function testConstructCorrectInstance()
    {
        $field = new Hidden('hiddenField', []);

        $this->assertInstanceOf('\\PitchBlade\\Form\\Field\\Generic', $field);
    }

    /**
     * @covers PitchBlade\Form\Field\Hidden::__construct
     */
    public function testConstructCorrectType()
    {
        $field = new Hidden('hiddenField', []);

        $this->assertSame('hidden', $field->getType());
    }
}
