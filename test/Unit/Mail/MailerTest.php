<?php

namespace PitchBladeTest\Unit\Mail;

use PitchBlade\Mail\Mailer,
    PitchBladeTest\Mocks\Mail\Message,
    PitchBlade\Mail\Recipient;

class MailerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Mail\Message::__construct
     */
    public function testConstructCorrectInterfaceWithoutXMailer()
    {
        $mailer = new Mailer(new Message());
        $this->assertInstanceOf('\\PitchBlade\\Mail\\Transporter', $mailer);
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     */
    public function testConstructCorrectInterfaceWithXMailer()
    {
        $mailer = new Mailer(new Message(), 'TEST');
        $this->assertInstanceOf('\\PitchBlade\\Mail\\Transporter', $mailer);
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::getRecipients
     * @covers PitchBlade\Mail\Message::getHeaders
     * @covers PitchBlade\Mail\Message::__construct
     */
    public function testSendThrowsExceptionMissingRecipient()
    {
        $mailer = new Mailer(new Message(['recipients' => []]));

        $this->setExpectedException('\\PitchBlade\\Mail\\MissingRecipientException');

        $mailer->send();
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::getRecipients
     * @covers PitchBlade\Mail\Message::getHeaders
     * @covers PitchBlade\Mail\Message::__construct
     */
    public function testSendThrowsExceptionFailedToDeliver()
    {
        $mailer = new Mailer(new Message(['recipients' => [new Recipient('peehaa@php.net')]]));

        $this->setExpectedException('\\PitchBlade\\Mail\\SendFailureException');

        $mailer->send();
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::getRecipients
     * @covers PitchBlade\Mail\Message::getHeaders
     * @covers PitchBlade\Mail\Message::__construct
     */
    /*
    public function testSendSuccess()
    {
        $mailer = new Mailer(new Message([
            'recipients' => [new Recipient('peehaa@php.net')],
            'headers' => ['From' => 'peehaa@php.net'],
            'subject' => 'My test subject',
        ]));

        $this->assertNull($mailer->send());
    }
    */
}
