<?php

namespace PitchBladeTest\Unit\Mail;

use PitchBlade\Mail\Mailer;

class MailerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Mail\Mailer::__construct
     */
    public function testConstructCorrectInterfaceWithoutXMailer()
    {
        $mailer = new Mailer($this->getMock('\\PitchBlade\\Mail\\Deliverable'));
        $this->assertInstanceOf('\\PitchBlade\\Mail\\Transporter', $mailer);
    }

    /**
     * @covers PitchBlade\Mail\Mailer::__construct
     */
    public function testConstructCorrectInterfaceWithXMailer()
    {
        $mailer = new Mailer($this->getMock('\\PitchBlade\\Mail\\Deliverable'), 'TEST');
        $this->assertInstanceOf('\\PitchBlade\\Mail\\Transporter', $mailer);
    }

    /**
     * @covers PitchBlade\Mail\Mailer::__construct
     * @covers PitchBlade\Mail\Mailer::getRecipients
     * @covers PitchBlade\Mail\Mailer::getHeaders
     */
    public function testSendThrowsExceptionMissingRecipient()
    {
        $message = $this->getMock('\\PitchBlade\\Mail\\Deliverable');
        $message->expects($this->once())
            ->method('getRecipients')
            ->will($this->returnValue([]));

        $mailer = new Mailer($message);

        $this->setExpectedException('\\PitchBlade\\Mail\\MissingRecipientException');

        $mailer->send();
    }

    /**
     * @covers PitchBlade\Mail\Mailer::__construct
     * @covers PitchBlade\Mail\Mailer::getRecipients
     * @covers PitchBlade\Mail\Mailer::getHeaders
     */
    public function testSendThrowsExceptionFailedToDeliver()
    {
        $recipient = $this->getMock('\\PitchBlade\\Mail\\Address');
        $recipient->expects($this->once())
            ->method('getRfcAddress')
            ->$this->returnValue('peehaa@xshghxgsxhjsdgbchdsgchjsdgcbhdsg');

        $message = $this->getMock('\\PitchBlade\\Mail\\Deliverable');
        $message->expects($this->any())
            ->method('getRecipients')
            ->will($this->returnValue([$recipient]));

        $mailer = new Mailer($message);

        $this->setExpectedException('\\PitchBlade\\Mail\\SendFailureException');

        $mailer->send();
    }
}
