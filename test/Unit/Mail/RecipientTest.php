<?php

namespace PitchBladeTest\Unit\Mail;

use PitchBlade\Mail\Recipient;

class RecipientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Mail\Recipient::__construct
     */
    public function testConstructCorrectInterface()
    {
        $address = new Recipient('peehaa@php.net', 'Pieter Hordijk');

        $this->assertInstanceOf('\\PitchBlade\\Mail\\Address', $address);
    }

    /**
     * @covers PitchBlade\Mail\Recipient::__construct
     */
    public function testConstructCorrectInterfaceWithoutName()
    {
        $address = new Recipient('peehaa@php.net');

        $this->assertInstanceOf('\\PitchBlade\\Mail\\Address', $address);
    }

    /**
     * @covers PitchBlade\Mail\Recipient::__construct
     */
    public function testConstructThrowsExceptionOnInvalidEmailaddress()
    {
        $this->setExpectedException('\\PitchBlade\\Mail\\InvalidAddressException');

        $address = new Recipient('peehaa', 'Pieter Hordijk');
    }

    /**
     * @covers PitchBlade\Mail\Recipient::__construct
     * @covers PitchBlade\Mail\Recipient::getAddress
     */
    public function testGetAddress()
    {
        $address = new Recipient('peehaa@php.net', 'Pieter Hordijk');

        $this->assertSame('peehaa@php.net', $address->getAddress());
    }

    /**
     * @covers PitchBlade\Mail\Recipient::__construct
     * @covers PitchBlade\Mail\Recipient::getName
     */
    public function testGetNameFilled()
    {
        $address = new Recipient('peehaa@php.net', 'Pieter Hordijk');

        $this->assertSame('Pieter Hordijk', $address->getName());
    }

    /**
     * @covers PitchBlade\Mail\Recipient::__construct
     * @covers PitchBlade\Mail\Recipient::getName
     */
    public function testGetNameNull()
    {
        $address = new Recipient('peehaa@php.net');

        $this->assertNull($address->getName());
    }

    /**
     * @covers PitchBlade\Mail\Recipient::__construct
     * @covers PitchBlade\Mail\Recipient::getRfcAddress
     */
    public function testGetRfcAddressWithName()
    {
        $address = new Recipient('peehaa@php.net', 'Pieter Hordijk');

        $this->assertSame('Pieter Hordijk <peehaa@php.net>', $address->getRfcAddress());
    }

    /**
     * @covers PitchBlade\Mail\Recipient::__construct
     * @covers PitchBlade\Mail\Recipient::getRfcAddress
     */
    public function testGetRfcAddressWithoutName()
    {
        $address = new Recipient('peehaa@php.net');

        $this->assertSame('peehaa@php.net', $address->getRfcAddress());
    }
}
