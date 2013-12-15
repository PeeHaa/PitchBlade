<?php

namespace PitchBladeTest\Storage;

use PitchBlade\Storage\ImmutableArray;

class ImmutableArrayTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Storage\ImmutableArray::__construct
     */
    public function testConstructCorrectInterface()
    {
        $array = new ImmutableArray();

        $this->assertInstanceOf('\\PitchBlade\\Storage\\ImmutableKeyValue', $array);
    }

    /**
     * @covers PitchBlade\Storage\ImmutableArray::__construct
     */
    public function testConstructCorrectInstance()
    {
        $array = new ImmutableArray();

        $this->assertInstanceOf('\\PitchBlade\\Storage\\ImmutableArray', $array);
    }

    /**
     * @covers PitchBlade\Storage\ImmutableArray::__construct
     * @covers PitchBlade\Storage\ImmutableArray::isKeyValid
     */
    public function testIsKeyValidInvalid()
    {
        $array = new ImmutableArray();

        $this->assertFalse($array->isKeyValid('foo'));
    }

    /**
     * @covers PitchBlade\Storage\ImmutableArray::__construct
     * @covers PitchBlade\Storage\ImmutableArray::isKeyValid
     */
    public function testIsKeyValidValid()
    {
        $array = new ImmutableArray(['foo' => 'bar']);

        $this->assertTrue($array->isKeyValid('foo'));
    }

    /**
     * @covers PitchBlade\Storage\ImmutableArray::__construct
     * @covers PitchBlade\Storage\ImmutableArray::get
     */
    public function testGetExists()
    {
        $array = new ImmutableArray(['foo' => 'bar']);

        $this->assertSame('bar', $array->get('foo'));
    }

    /**
     * @covers PitchBlade\Storage\ImmutableArray::__construct
     * @covers PitchBlade\Storage\ImmutableArray::get
     */
    public function testGetNotExistsDefaultValue()
    {
        $array = new ImmutableArray();

        $this->assertNull($array->get('foo'));
    }

    /**
     * @covers PitchBlade\Storage\ImmutableArray::__construct
     * @covers PitchBlade\Storage\ImmutableArray::get
     */
    public function testGetNotExistsCustomDefaultValue()
    {
        $array = new ImmutableArray();

        $this->assertSame('bar', $array->get('foo', 'bar'));
    }

    /**
     * @covers PitchBlade\Storage\ImmutableArray::__construct
     * @covers PitchBlade\Storage\ImmutableArray::rewind
     * @covers PitchBlade\Storage\ImmutableArray::current
     * @covers PitchBlade\Storage\ImmutableArray::key
     * @covers PitchBlade\Storage\ImmutableArray::next
     * @covers PitchBlade\Storage\ImmutableArray::valid
     */
    public function testIterator()
    {
        $source = [
            'first'  => 1,
            'second' => 2,
            'last'   => 3,
        ];

        $array = new ImmutableArray($source);

        $i = 0;
        foreach ($array as $key => $value) {
            $this->assertSame(array_keys($source)[$i], $key);
            $this->assertSame($source[$key], $value);

            $i++;
        }

        $i = 0;
        foreach ($array as $key => $value) {
            $this->assertSame(array_keys($source)[$i], $key);
            $this->assertSame($source[$key], $value);

            $i++;
        }
    }
}
