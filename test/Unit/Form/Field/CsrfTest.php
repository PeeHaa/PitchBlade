<?php

namespace PitchBladeTest\Unit\Form\Field;

use PitchBlade\Form\Field\Csrf;

class CsrfTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Form\Field\Csrf::__construct
     */
    public function testConstructCorrectInstance()
    {
        $field = new Csrf('csrfField', ['default' => 'defaultValue']);

        $this->assertInstanceOf('\\PitchBlade\\Form\\Field\\Generic', $field);
        $this->assertInstanceOf('\\PitchBlade\\Form\\Field\\Hidden', $field);
    }

    /**
     * @covers PitchBlade\Form\Field\Csrf::__construct
     * @covers PitchBlade\Form\Field\Csrf::getValue
     */
    public function testGetValue()
    {
        $field = new Csrf('csrfField', ['default' => 'defaultValue']);

        $this->assertSame('defaultValue', $field->getValue());
    }

    /**
     * @covers PitchBlade\Form\Field\Csrf::__construct
     * @covers PitchBlade\Form\Field\Csrf::getValue
     */
    public function testGetValueOverridden()
    {
        $field = new Csrf('csrfField', ['default' => 'defaultValue']);

        $field->setRawValue('Overridden value');

        $this->assertSame('defaultValue', $field->getValue());
    }
}
