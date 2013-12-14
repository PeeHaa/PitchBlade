<?php

namespace PitchBladeTest\Unit\Form;

class FormTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Form\Form::__construct
     */
    public function testConstructCorrectInterfaces()
    {
        $form = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Form', [
                $this->getMock('PitchBlade\\Form\\Field\\Builder'),
                $this->getMock('PitchBlade\\Security\\TokenGenerator'),
            ]
        );

        $this->assertInstanceOf('\\PitchBlade\\Form\\Validatable', $form);
        $this->assertInstanceOf('\\PitchBlade\\Form\\Form', $form);
    }

    /**
     * @covers PitchBlade\Form\Form::__construct
     * @covers PitchBlade\Form\Form::bind
     */
    public function testBindWithoutFields()
    {
        $form = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Form', [
                $this->getMock('PitchBlade\\Form\\Field\\Builder'),
                $this->getMock('PitchBlade\\Security\\TokenGenerator'),
            ]
        );

        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('postIterator')
            ->will($this->returnValue(['var' => 'value']));

        $this->assertNull($form->bind($request));
    }

    /**
     * @covers PitchBlade\Form\Form::__construct
     * @covers PitchBlade\Form\Form::addField
     * @covers PitchBlade\Form\Form::bind
     */
    public function testBindWithField()
    {
        $fieldFactory = $this->getMock('\\PitchBlade\\Form\\Field\\Builder');
        $fieldFactory->expects($this->at(0))
            ->method('build')
            ->will($this->returnCallback(function($name, $data) {
                return $this->getMockForAbstractClass('\\PitchBlade\\Form\\Field\\Generic', [
                    $name, $data
                ]);
            }));
        $fieldFactory->expects($this->at(1))
            ->method('build')
            ->will($this->returnCallback(function($name, $data) {
                return $this->getMockForAbstractClass('\\PitchBlade\\Form\\Field\\Generic', [
                    $name, $data
                ]);
            }));

        $form = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Form', [
                $fieldFactory,
                $this->getMock('\\PitchBlade\\Security\\TokenGenerator'),
            ]
        );

        $form->addField('testField', []);

        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('postIterator')
            ->will($this->returnValue([
                'var' => 'value',
                'testField' => 'value',
            ]));

        $this->assertNull($form->bind($request));
    }

    /**
     * @covers PitchBlade\Form\Form::__construct
     * @covers PitchBlade\Form\Form::addField
     */
    public function testAddField()
    {
        $form = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Form', [
                $this->getMock('PitchBlade\\Form\\Field\\Builder'),
                $this->getMock('PitchBlade\\Security\\TokenGenerator'),
            ]
        );

        $form->addField('testField', []);
    }

    /**
     * @covers PitchBlade\Form\Form::__construct
     * @covers PitchBlade\Form\Form::addField
     * @covers PitchBlade\Form\Form::getField
     */
    public function testGetFieldValid()
    {
        $fieldFactory = $this->getMock('\\PitchBlade\\Form\\Field\\Builder');
        $fieldFactory->expects($this->at(0))
            ->method('build')
            ->will($this->returnCallback(function($name, $data) {
                return $this->getMockForAbstractClass('\\PitchBlade\\Form\\Field\\Generic', [
                    $name, $data
                ]);
            }));
        $fieldFactory->expects($this->at(1))
            ->method('build')
            ->will($this->returnCallback(function($name, $data) {
                return $this->getMockForAbstractClass('\\PitchBlade\\Form\\Field\\Text', [
                    $name, $data
                ]);
            }));

        $form = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Form', [
                $fieldFactory,
                $this->getMock('PitchBlade\\Security\\TokenGenerator'),
            ]
        );

        $form->addField('testField', []);

        $this->assertInstanceOf(
            '\\PitchBlade\\Form\\Field\\Text',
            $form->getField('testField')
        );
        $this->assertInstanceOf(
            '\\PitchBlade\\Form\\Field\\Generic',
            $form->getField('testField')
        );
    }

    /**
     * @covers PitchBlade\Form\Form::__construct
     * @covers PitchBlade\Form\Form::getField
     */
    public function testGetFieldInvalidField()
    {
        $form = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Form', [
                $this->getMock('\\PitchBlade\\Form\\Field\\Builder'),
                $this->getMock('PitchBlade\\Security\\TokenGenerator'),
            ]
        );

        $this->setExpectedException(
            '\\PitchBlade\\Form\\InvalidFieldException'
        );

        $form->getField('testField');
    }

    /**
     * @covers PitchBlade\Form\Form::__construct
     * @covers PitchBlade\Form\Form::isValid
     */
    public function testIsValidValidWithoutFields()
    {
        $this->markTestSkipped(
            'I need to either find a way to override the concrete isValid() method or create a mock manually otherwise'
        );

        $fieldFactory = $this->getMock('\\PitchBlade\\Form\\Field\\Builder');
        $fieldFactory->expects($this->at(0))
            ->method('build')
            ->will($this->returnCallback(function($name, $data) {
                $csrfField = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Field\\Generic', [
                    $name, $data
                ]);
                $csrfField->expects($this->once())->method('isValid')->will($this->returnValue(true));

                return $csrfField;
            }));

        $form = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Form', [
                $fieldFactory,
                $this->getMock('PitchBlade\\Security\\TokenGenerator'),
            ]
        );

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
        $this->markTestSkipped(
            'I need to either find a way to override the concrete isValid() method or create a mock manually otherwise'
        );

        $fieldFactory = $this->getMock('\\PitchBlade\\Form\\Field\\Builder');
        $fieldFactory->expects($this->at(0))
            ->method('build')
            ->will($this->returnCallback(function($name, $data) {
                $csrfField = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Field\\Generic', [
                    $name, $data
                ]);
                $csrfField->expects($this->once())->method('isValid')->will($this->returnValue(true));

                return $csrfField;
            }));
        $fieldFactory->expects($this->at(1))
            ->method('build')
            ->will($this->returnCallback(function($name, $data) {
                $textField = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Field\\Generic', [
                    $name, $data
                ]);
                $textField->expects($this->once())->method('isValid')->will($this->returnValue(false));

                return $textField;
            }));

        $form = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Form', [
                $fieldFactory,
                $this->getMock('PitchBlade\\Security\\TokenGenerator'),
            ]
        );

        $form->addField('testField', []);

        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('postIterator')
            ->will($this->returnValue([
                'var' => 'value', 'testField' => 'value'
            ]));

        $form->bind($request);

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
        $this->markTestSkipped(
            'I need to either find a way to override the concrete isValid() method or create a mock manually otherwise'
        );

        $fieldFactory = $this->getMock('\\PitchBlade\\Form\\Field\\Builder');
        $fieldFactory->expects($this->at(0))
            ->method('build')
            ->will($this->returnCallback(function($name, $data) {
                $csrfField = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Field\\Generic', [
                    $name, $data
                ]);
                $csrfField->expects($this->once())->method('isValid')->will($this->returnValue(true));

                return $csrfField;
            }));
        $fieldFactory->expects($this->at(1))
            ->method('build')
            ->will($this->returnCallback(function($name, $data) {
                $textField = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Field\\Generic', [
                    $name, $data
                ]);
                $textField->expects($this->once())->method('isValid')->will($this->returnValue(false));

                return $textField;
            }));

        $form = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Form', [
                $fieldFactory,
                $this->getMock('PitchBlade\\Security\\TokenGenerator'),
            ]
        );

        $form->addField('testField', []);

        $request = $this->getMock('\\PitchBlade\\Network\\Http\\RequestData');
        $request->expects($this->once())
            ->method('postIterator')
            ->will($this->returnValue([
                'var' => 'value', 'testField' => 'value'
            ]));

        $form->bind($request);

        $this->assertFalse($form->isValid());
    }
}
