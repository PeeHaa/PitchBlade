<?php

namespace PitchBladeTest\Unit\Mail;

use PitchBlade\Mail\Message,
    PitchBlade\Mail\Recipient;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Mail\Message::__construct
     */
    public function testConstructCorrectInterfaceWithCharset()
    {
        $message = new Message(new Recipient('peehaa@php.net'), 'test', 'utf-8');

        $this->assertInstanceOf('\\PitchBlade\\Mail\\Deliverable', $message);
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     */
    public function testConstructCorrectInterfaceWithoutCharset()
    {
        $message = new Message(new Recipient('peehaa@php.net'), 'test');

        $this->assertInstanceOf('\\PitchBlade\\Mail\\Deliverable', $message);
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::setReplyTo
     */
    public function testSetReplyTo()
    {
        $message = new Message(new Recipient('peehaa@php.net'), 'test');

        $this->assertNull($message->setReplyTo(new Recipient('peehaa@php.net')));
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::addCc
     */
    public function testAddCc()
    {
        $message = new Message(new Recipient('peehaa@php.net'), 'test');

        $this->assertNull($message->addCc(new Recipient('peehaa@php.net')));
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::addBcc
     */
    public function testAddBcc()
    {
        $message = new Message(new Recipient('peehaa@php.net'), 'test');

        $this->assertNull($message->addBcc(new Recipient('peehaa@php.net')));
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::setPlainTextBody
     */
    public function testSetPlainTextBody()
    {
        $message = new Message(new Recipient('peehaa@php.net'), 'test');

        $this->assertNull($message->setPlainTextBody('plainText'));
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::setBodyHtml
     */
    public function testSetHtmlBody()
    {
        $message = new Message(new Recipient('peehaa@php.net'), 'test');

        $this->assertNull($message->setBodyHtml('<p>html</p>'));
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::getHeaders
     */
    public function testGetHeadersWithoutExtraRecipients()
    {
        $message = new Message(new Recipient('peehaa@php.net'), 'test');

        $this->assertSame('peehaa@php.net', $message->getHeaders()['From']);
        $this->assertSame('peehaa@php.net', $message->getHeaders()['Reply-To']);
        $this->assertSame(1, preg_match('/^multipart\/alternative; boundary="PHP-alt-(.+)"$/', $message->getHeaders()['Content-Type']));
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::getHeaders
     * @covers PitchBlade\Mail\Message::addRecipientsHeader
     */
    public function testGetHeadersWithCcAddress()
    {
        $message = new Message(new Recipient('peehaa@php.net'), 'test');

        $message->addCc(new Recipient('peehaa@php.net'));

        $this->assertSame('peehaa@php.net', $message->getHeaders()['From']);
        $this->assertSame('peehaa@php.net', $message->getHeaders()['Reply-To']);
        $this->assertSame(1, preg_match('/^multipart\/alternative; boundary="PHP-alt-(.+)"$/', $message->getHeaders()['Content-Type']));
        $this->assertSame('peehaa@php.net', $message->getHeaders()['Cc']);
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::getHeaders
     * @covers PitchBlade\Mail\Message::addRecipientsHeader
     */
    public function testGetHeadersWithMultipleCcAddresses()
    {
        $message = new Message(new Recipient('peehaa@php.net'), 'test');

        $message->addCc(new Recipient('peehaa@php.net'));
        $message->addCc(new Recipient('pieter@php.net'));

        $this->assertSame('peehaa@php.net', $message->getHeaders()['From']);
        $this->assertSame('peehaa@php.net', $message->getHeaders()['Reply-To']);
        $this->assertSame(1, preg_match('/^multipart\/alternative; boundary="PHP-alt-(.+)"$/', $message->getHeaders()['Content-Type']));
        $this->assertSame('peehaa@php.net, pieter@php.net', $message->getHeaders()['Cc']);
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::getHeaders
     * @covers PitchBlade\Mail\Message::addRecipientsHeader
     */
    public function testGetHeadersWithBccAddress()
    {
        $message = new Message(new Recipient('peehaa@php.net'), 'test');

        $message->addBcc(new Recipient('peehaa@php.net'));

        $this->assertSame('peehaa@php.net', $message->getHeaders()['From']);
        $this->assertSame('peehaa@php.net', $message->getHeaders()['Reply-To']);
        $this->assertSame(1, preg_match('/^multipart\/alternative; boundary="PHP-alt-(.+)"$/', $message->getHeaders()['Content-Type']));
        $this->assertSame('peehaa@php.net', $message->getHeaders()['Bcc']);
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::getHeaders
     * @covers PitchBlade\Mail\Message::addRecipientsHeader
     */
    public function testGetHeadersWithMultipleBccAddresses()
    {
        $message = new Message(new Recipient('peehaa@php.net'), 'test');

        $message->addBcc(new Recipient('peehaa@php.net'));
        $message->addBcc(new Recipient('pieter@php.net'));

        $this->assertSame('peehaa@php.net', $message->getHeaders()['From']);
        $this->assertSame('peehaa@php.net', $message->getHeaders()['Reply-To']);
        $this->assertSame(1, preg_match('/^multipart\/alternative; boundary="PHP-alt-(.+)"$/', $message->getHeaders()['Content-Type']));
        $this->assertSame('peehaa@php.net, pieter@php.net', $message->getHeaders()['Bcc']);
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::getHeaders
     * @covers PitchBlade\Mail\Message::addRecipientsHeader
     */
    public function testGetHeadersWithBothCcAndBccAddresses()
    {
        $message = new Message(new Recipient('peehaa@php.net'), 'test');

        $message->addCc(new Recipient('peehaa@php.net'));
        $message->addBcc(new Recipient('pieter@php.net'));

        $this->assertSame('peehaa@php.net', $message->getHeaders()['From']);
        $this->assertSame('peehaa@php.net', $message->getHeaders()['Reply-To']);
        $this->assertSame(1, preg_match('/^multipart\/alternative; boundary="PHP-alt-(.+)"$/', $message->getHeaders()['Content-Type']));
        $this->assertSame('peehaa@php.net', $message->getHeaders()['Cc']);
        $this->assertSame('pieter@php.net', $message->getHeaders()['Bcc']);
    }


    /**
     * Builds the mail body (the actual message to be send)
     *
     * return string The message body
     */
     /*
    public function getMessageBody()
    {
        $message = '';

        if ($this->plainTextBody !== null) {
            $message.= '--PHP-alt-' . $this->boundary . "\r\n";
            $message.= 'Content-Type: text/plain; charset="' . $this->charset . '"' . "\r\n";
            $message.= 'Content-Transfer-Encoding: 7bit' . "\r\n\r\n";
            $message.= $this->plainTextBody ."\r\n\r\n";
        }

        if ($this->htmlBody !== null) {
            $message.= '--PHP-alt-' . $this->boundary . "\r\n";
            $message.= 'Content-Type: text/html; charset="' . $this->boundary . '"' . "\r\n";
            $message.= 'Content-Transfer-Encoding: 7bit' . "\r\n\r\n";
            $message.= $this->htmlBody . "\r\n\r\n";
        }

        return $message . '--PHP-alt-' . $this->boundary . '--' . "\r\n";
    }
    */
}
