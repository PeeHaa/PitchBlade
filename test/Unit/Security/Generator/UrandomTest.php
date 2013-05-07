<?php

namespace PitchBladeTest\Unit\Security\Generator;

use PitchBlade\Security\Generator\Urandom;

class UrandomTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Security\Generator\Urandom::__construct
     */
    public function testConstructCorrectInterface()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $this->setExpectedException('\\PitchBlade\\Security\Generator\\UnsupportedAlgorithmException');
        }

        $generator = new Urandom();

        if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            $this->assertInstanceOf('\\PitchBlade\\Security\\Generator');
        }
    }

    /**
     * @covers PitchBlade\Security\Generator\Urandom::__construct
     * @covers PitchBlade\Security\Generator\Urandom::generate
     */
    public function testGenerate()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $this->setExpectedException('\\PitchBlade\\Security\Generator\\UnsupportedAlgorithmException');
        }

        $generator = new Urandom();

        if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            $this->assertSame(128, strlen($generator->generate(128)));
        }
    }

    /**
     * @covers PitchBlade\Security\Generator\Urandom::__construct
     * @covers PitchBlade\Security\Generator\Urandom::generate
     */
    public function testGenerateRandomTheStupidWay()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $this->setExpectedException('\\PitchBlade\\Security\Generator\\UnsupportedAlgorithmException');
        }

        $generator = new Urandom();

        if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            $strings = [];
            for ($i = 0; $i < 10; $i++) {
                $strings[] = $generator->generate(56);
            }

            $this->assertSame($strings, array_unique($strings));
        }
    }
}
