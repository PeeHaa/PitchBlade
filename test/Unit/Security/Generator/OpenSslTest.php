<?php

namespace PitchBladeTest\Unit\Security\Generator;

use PitchBlade\Security\Generator\OpenSsl;

class OpenSslTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Security\Generator\OpenSsl::__construct
     */
    public function testConstructCorrectInterface()
    {
        $generator = new OpenSsl();

        $this->assertInstanceOf('\\PitchBlade\\Security\\Generator', $generator);
    }

    /**
     * @covers PitchBlade\Security\Generator\OpenSsl::__construct
     * @covers PitchBlade\Security\Generator\OpenSsl::generate
     */
    public function testGenerate()
    {
        $generator = new OpenSsl();

        $this->assertSame(128, strlen($generator->generate(128)));
    }

    /**
     * @covers PitchBlade\Security\Generator\OpenSsl::__construct
     * @covers PitchBlade\Security\Generator\OpenSsl::generate
     */
    public function testGenerateRandomTheStupidWay()
    {
        $generator = new OpenSsl();

        $strings = [];
        for ($i = 0; $i < 10; $i++) {
            $strings[] = $generator->generate(56);
        }

        $this->assertSame($strings, array_unique($strings));
    }
}
