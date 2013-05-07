<?php

namespace PitchBladeTest\Unit\Security\Generator;

use PitchBlade\Security\Generator\MtRand;

class MtRandTest extends \PHPUnit_Framework_TestCase
{
    /**
     */
    public function testConstructCorrectInterface()
    {
        $generator = new MtRand();

        $this->assertInstanceOf('\\PitchBlade\\Security\\Generator', $generator);
    }

    /**
     * @covers PitchBlade\Security\Generator\MtRand::generate
     */
    public function testGenerate()
    {
        $generator = new MtRand();

        $this->assertSame(128, strlen($generator->generate(128)));
    }

    /**
     * @covers PitchBlade\Security\Generator\MtRand::generate
     */
    public function testGenerateRandomTheStupidWay()
    {
        $generator = new MtRand();

        $strings = [];
        for ($i = 0; $i < 10; $i++) {
            $strings[] = $generator->generate(56);
        }

        $this->assertSame($strings, array_unique($strings));
    }
}
