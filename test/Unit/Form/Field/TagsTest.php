<?php

namespace PitchBladeTest\Unit\Form\Field;

use PitchBlade\Form\Field\Tags;

class TagsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Form\Field\Tags::__construct
     */
    public function testConstructCorrectInstance()
    {
        $field = new Tags('tagsField', ['options' => []]);

        $this->assertInstanceOf('\\PitchBlade\\Form\\Field\\Generic', $field);
    }

    /**
     * @covers PitchBlade\Form\Field\Tags::__construct
     */
    public function testConstructCorrectType()
    {
        $field = new Tags('tagsField', ['options' => []]);

        $this->assertSame('tags', $field->getType());
    }
}
