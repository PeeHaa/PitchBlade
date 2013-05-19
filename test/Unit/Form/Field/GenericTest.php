<?php

namespace PitchBladeTest\Unit\Form\Field;

class GenericTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     */
    public function testConstructWithoutData()
    {
        $field = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Field\\Generic', ['testField', []]);

        $this->assertInstanceOf('\\PitchBlade\\Form\\Field\\Generic', $field);
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     */
    public function testConstructWithClass()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['class' => 'class']]
        );

        $this->assertInstanceOf('\\PitchBlade\\Form\\Field\\Generic', $field);
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     */
    public function testConstructWithRequirements()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => 'requirements']]
        );

        $this->assertInstanceOf('\\PitchBlade\\Form\\Field\\Generic', $field);
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     */
    public function testConstructWithOptions()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['options' => 'options']]
        );

        $this->assertInstanceOf('\\PitchBlade\\Form\\Field\\Generic', $field);
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     */
    public function testConstructWithDefault()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['default' => 'default']]
        );

        $this->assertInstanceOf('\\PitchBlade\\Form\\Field\\Generic', $field);
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getName
     */
    public function testGetName()
    {
        $field = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Field\\Generic', ['testField', []]);

        $this->assertSame('testField', $field->getName());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getName
     */
    public function testGetType()
    {
        $field = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Field\\Generic', ['testField', []]);

        $this->assertNull($field->getType());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getClass
     */
    public function testGetClassUndefined()
    {
        $field = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Field\\Generic', ['testField', []]);

        $this->assertNull($field->getClass());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getClass
     */
    public function testGetClassDefined()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['class' => 'fieldClass']]
        );

        $this->assertSame('fieldClass', $field->getClass());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::setRawValue
     */
    public function testSetRawValue()
    {
        $field = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Field\\Generic', ['testField', []]);

        $this->assertNull($field->setRawValue('testValue'));
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getValue
     */
    public function testGetValueWithValue()
    {
        $field = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Field\\Generic', ['testField', []]);

        $field->setRawValue('testValue');

        $this->assertSame('testValue', $field->getValue());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getValue
     */
    public function testGetValueWithValueTrimmed()
    {
        $field = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Field\\Generic', ['testField', []]);

        $field->setRawValue('  testValue  ');

        $this->assertSame('testValue', $field->getValue());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getValue
     */
    public function testGetValueWithoutValueWithoutDefault()
    {
        $field = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Field\\Generic', ['testField', []]);

        $field->setRawValue('');

        $this->assertNull($field->getValue());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getValue
     */
    public function testGetValueWithoutValueWithDefault()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['default' => 'testDefault']]
        );

        $field->setRawValue('');

        $this->assertSame('testDefault', $field->getValue());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getValue
     */
    public function testGetValueWithNullValueWithoutDefault()
    {
        $field = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Field\\Generic', ['testField', []]);

        $this->assertNull($field->getValue());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getValue
     */
    public function testGetValueWithNullValueWithDefault()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['default' => 'testDefault']]
        );

        $this->assertSame('testDefault', $field->getValue());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getOptions
     */
    public function testGetOptionsEmpty()
    {
        $field = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Field\\Generic', ['testField', []]);

        $this->assertSame([], $field->getOptions());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getOptions
     */
    public function testGetOptionsFilled()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['options' => [1, 2]]]
        );

        $this->assertSame([1, 2], $field->getOptions());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testIsValidWithoutRequirementsOrOptions()
    {
        $field = $this->getMockForAbstractClass('\\PitchBlade\\Form\\Field\\Generic', ['testField', []]);

        $this->assertTrue($field->isValid());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testIsValidValidOptions()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['options' => ['1', '2']]]
        );

        $field->setRawValue('1');

        $this->assertTrue($field->isValid());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testIsValidInvalidOptions()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['options' => ['1', '2']]]
        );

        $field->setRawValue('invalid value');

        $this->assertFalse($field->isValid());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testIsValidValidRequired()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['required' => true]]]
        );

        $field->setRawValue('1');

        $this->assertTrue($field->isValid());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testIsValidInvalidRequiredNull()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['required' => true]]]
        );

        $this->assertFalse($field->isValid());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testIsValidInvalidRequiredEmpty()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['required' => true]]]
        );

        $field->setRawValue('');

        $this->assertFalse($field->isValid());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testIsValidInvalidRequiredEmptyTrimmed()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['required' => true]]]
        );

        $field->setRawValue('    ');

        $this->assertFalse($field->isValid());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testIsValidMinValidExact()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['min' => 5]]]
        );

        $field->setRawValue('12345');

        $this->assertTrue($field->isValid());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testIsValidMinValidMore()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['min' => 5]]]
        );

        $field->setRawValue('123456');

        $this->assertTrue($field->isValid());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testIsValidMinInvalidLess()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['min' => 5]]]
        );

        $field->setRawValue('1234');

        $this->assertFalse($field->isValid());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testIsValidMinInvalidLessTrimmed()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['min' => 5]]]
        );

        $field->setRawValue('1234  ');

        $this->assertFalse($field->isValid());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testIsValidMinInvalidEmpty()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['min' => 5]]]
        );

        $field->setRawValue('');

        $this->assertFalse($field->isValid());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testIsValidMinInvalidNull()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['min' => 5]]]
        );

        $this->assertFalse($field->isValid());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testIsValidMaxValidMore()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['max' => 5]]]
        );

        $field->setRawValue('1234');

        $this->assertTrue($field->isValid());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testIsValidMaxInvalidMore()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['max' => 5]]]
        );

        $field->setRawValue('123456');

        $this->assertFalse($field->isValid());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testIsValidMaxValidTrimmed()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['max' => 5]]]
        );

        $field->setRawValue('1234 ');

        $this->assertTrue($field->isValid());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testIsValidMaxValidEmpty()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['max' => 5]]]
        );

        $field->setRawValue('');

        $this->assertTrue($field->isValid());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testIsValidMaxValidNull()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['max' => 5]]]
        );

        $this->assertTrue($field->isValid());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testIsValidRegexValid()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['regex' => '/^testPattern$/']]]
        );

        $field->setRawValue('testPattern');

        $this->assertTrue($field->isValid());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testIsValidRegexValidTrimmed()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['regex' => '/^testPattern$/']]]
        );

        $field->setRawValue('  testPattern  ');

        $this->assertTrue($field->isValid());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testIsValidRegexInvalidEmpty()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['regex' => '/^testPattern$/']]]
        );

        $field->setRawValue('');

        $this->assertFalse($field->isValid());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testIsValidRegexInvalidNull()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['regex' => '/^testPattern$/']]]
        );

        $this->assertFalse($field->isValid());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testHasErrorsWithErrors()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['min' => 5]]]
        );

        $field->setRawValue('1234');

        $this->assertFalse($field->isValid());
        $this->assertTrue($field->hasErrors());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     */
    public function testHasErrorsWithoutErrors()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['min' => 5]]]
        );

        $field->setRawValue('12345');

        $this->assertTrue($field->isValid());
        $this->assertFalse($field->hasErrors());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     * @covers PitchBlade\Form\Field\Generic::getFirstError
     */
    public function testGetFirstErrorWithError()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['min' => 5]]]
        );

        $field->setRawValue('1234');

        $this->assertFalse($field->isValid());
        $this->assertSame('min', $field->getFirstError());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     * @covers PitchBlade\Form\Field\Generic::getFirstError
     */
    public function testGetFirstErrorWithErrors()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['min' => 5, 'regex' => '/^noMatch$/']]]
        );

        $field->setRawValue('1234');

        $this->assertFalse($field->isValid());
        $this->assertSame('min', $field->getFirstError());
    }

    /**
     * @covers PitchBlade\Form\Field\Generic::__construct
     * @covers PitchBlade\Form\Field\Generic::getRawValue
     * @covers PitchBlade\Form\Field\Generic::isValid
     * @covers PitchBlade\Form\Field\Generic::hasErrors
     * @covers PitchBlade\Form\Field\Generic::getFirstError
     */
    public function testGetFirstErrorNoErrors()
    {
        $field = $this->getMockForAbstractClass(
            '\\PitchBlade\\Form\\Field\\Generic',
            ['testField', ['requirements' => ['min' => 5]]]
        );

        $field->setRawValue('12345');

        $this->assertTrue($field->isValid());
        $this->assertNull($field->getFirstError());
    }
}
