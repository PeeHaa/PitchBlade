<?php

namespace PitchBladeTest\Unit\Security\Generator;

use PitchBlade\Security\Generator\Mcrypt;

class McryptTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Security\Generator\Mcrypt::__construct
     */
    public function testConstructCorrectInterface()
    {
        $generator = new Mcrypt();

        $this->assertInstanceOf('\\PitchBlade\\Security\\Generator', $generator);
    }

    /**
     * @covers PitchBlade\Security\Generator\Mcrypt::__construct
     * @covers PitchBlade\Security\Generator\Mcrypt::generate
     */
    public function testGenerate()
    {
        $generator = new Mcrypt();

        $this->assertSame(128, strlen($generator->generate(128)));
    }

    /**
     * @covers PitchBlade\Security\Generator\Mcrypt::__construct
     * @covers PitchBlade\Security\Generator\Mcrypt::generate
     */
    public function testGenerateRandomTheStupidWay()
    {
        $generator = new Mcrypt();

        $strings = [];
        for ($i = 0; $i < 10; $i++) {
            $strings[] = $generator->generate(56);
        }

        $this->assertSame($strings, array_unique($strings));
    }
}
