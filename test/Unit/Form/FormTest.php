<?php

namespace PitchBladeTest\Unit\Form;

use PitchBladeTest\Mocks\Form\Field\Factory,
    PitchBladeTest\Mocks\Form\Field\InvalidFactory,
    PitchBladeTest\Mocks\Security\CsrfToken,
    PitchBladeTest\Mocks\Http\Request;

class FormTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Form\Form::__construct
     */
    public function testConstructCorrectInterfaces()
    {
        $form = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Form', [new Factory(), new CsrfToken()]);

        $this->assertInstanceOf('\\PitchBlade\\Form\\Validatable', $form);
        $this->assertInstanceOf('\\PitchBlade\\Form\\Form', $form);
        $this->assertInstanceOf('\\Iterator', $form);
    }

    /**
     * @covers PitchBlade\Form\Form::__construct
     * @covers PitchBlade\Form\Form::bind
     */
    public function testBindWithoutFields()
    {
        $form = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Form', [new Factory(), new CsrfToken()]);

        $this->assertNull($form->bind(new Request(['postVariables' => ['var' => 'value']])));
    }

    /**
     * @covers PitchBlade\Form\Form::__construct
     * @covers PitchBlade\Form\Form::addField
     * @covers PitchBlade\Form\Form::bind
     */
    public function testBindWithField()
    {
        $form = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Form', [new Factory(), new CsrfToken()]);

        $form->addField('testField', []);

        $this->assertNull($form->bind(new Request(['postVariables' => ['var' => 'value', 'testField' => 'value']])));
    }

    /**
     * @covers PitchBlade\Form\Form::__construct
     * @covers PitchBlade\Form\Form::addField
     */
    public function testAddField()
    {
        $form = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Form', [new Factory(), new CsrfToken()]);

        $form->addField('testField', []);
    }

    /**
     * @covers PitchBlade\Form\Form::__construct
     * @covers PitchBlade\Form\Form::addField
     * @covers PitchBlade\Form\Form::getField
     */
    public function testGetFieldValid()
    {
        $form = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Form', [new Factory(), new CsrfToken()]);

        $form->addField('testField', []);

        $this->assertInstanceOf('\\PitchBladeTest\\Mocks\\Form\\Field\\Dummy', $form->getField('testField'));
        $this->assertInstanceOf('\\PitchBlade\\Form\\Field\\Generic', $form->getField('testField'));
    }

    /**
     * @covers PitchBlade\Form\Form::__construct
     * @covers PitchBlade\Form\Form::getField
     */
    public function testGetFieldInvalidField()
    {
        $form = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Form', [new Factory(), new CsrfToken()]);

        $this->setExpectedException('\\PitchBlade\\Form\\InvalidFieldException');

        $form->getField('testField');
    }

    /**
     * @covers PitchBlade\Form\Form::__construct
     * @covers PitchBlade\Form\Form::isValid
     */
    public function testIsValidValidWithoutFields()
    {
        $form = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Form', [new Factory(), new CsrfToken()]);

        $this->assertTrue($form->isValid());
    }

    /**
     * @covers PitchBlade\Form\Form::__construct
     * @covers PitchBlade\Form\Form::addField
     * @covers PitchBlade\Form\Form::bind
     * @covers PitchBlade\Form\Form::isValid
     */
    public function testIsValidValidWithFields()
    {
        $form = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Form', [new Factory(), new CsrfToken()]);

        $form->addField('testField', []);

        $form->bind(new Request(['postVariables' => ['var' => 'value', 'testField' => 'value']]));

        $this->assertTrue($form->isValid());
    }

    /**
     * @covers PitchBlade\Form\Form::__construct
     * @covers PitchBlade\Form\Form::addField
     * @covers PitchBlade\Form\Form::bind
     * @covers PitchBlade\Form\Form::isValid
     */
    public function testIsValidInvalidWithFields()
    {
        $form = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Form', [new InvalidFactory(), new CsrfToken()]);

        $form->addField('testField', []);

        $form->bind(new Request(['postVariables' => ['var' => 'value', 'testField' => 'value']]));

        $this->assertFalse($form->isValid());
    }

    /**
     * @covers PitchBlade\Form\Form::__construct
     * @covers PitchBlade\Form\Form::addField
     * @covers PitchBlade\Form\Form::current
     * @covers PitchBlade\Form\Form::key
     * @covers PitchBlade\Form\Form::next
     * @covers PitchBlade\Form\Form::rewind
     * @covers PitchBlade\Form\Form::valid
     */
    public function testIterator()
    {
        $form = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Form', [new InvalidFactory(), new CsrfToken()]);

        $form->addField('testField1', []);
        $form->addField('testField2', []);
        $form->addField('testField3', []);
        $form->addField('testField4', []);
        $form->addField('testField5', []);

        $form->bind(new Request(['postVariables' => ['var' => 'value', 'testField' => 'value']]));

        $i = 0;
        foreach ($form as $key => $field) {
            $i++;
            if ($i === 1) {
                $this->assertSame('csrf-token', $key);
                continue;
            }

            $this->assertSame('testField' . ($i-1), $key);
        }

        $this->assertSame(6, $i);
    }
}
