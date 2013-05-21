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
     * @covers PitchBlade\Mail\Message::setHtmlBody
     */
    public function testSetHtmlBody()
    {
        $message = new Message(new Recipient('peehaa@php.net'), 'test');

        $this->assertNull($message->setHtmlBody('<p>html</p>'));
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
     * @covers PitchBlade\Mail\Message::addCc
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
     * @covers PitchBlade\Mail\Message::addCc
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
     * @covers PitchBlade\Mail\Message::addBcc
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
     * @covers PitchBlade\Mail\Message::addBcc
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
     * @covers PitchBlade\Mail\Message::addCc
     * @covers PitchBlade\Mail\Message::addBcc
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
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::setPlainTextBody
     * @covers PitchBlade\Mail\Message::getMessageBody
     */
    public function testGetMessageBodyThrowsExceptionOnNoContent()
    {
        $message = new Message(new Recipient('peehaa@php.net'), 'test');

        $this->setExpectedException('\\PitchBlade\\Mail\\MissingBodyException');

        $message->getMessageBody();
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::setPlainTextBody
     * @covers PitchBlade\Mail\Message::getMessageBody
     */
    public function testGetMessageBodyPlainTextOnly()
    {
        $message = new Message(new Recipient('peehaa@php.net'), 'test');

        $message->setPlainTextBody('plainText');

        $pattern = '/^--PHP-alt-(.+)\\r\\nContent-Type: text\/plain; charset="iso-8859-1"\\r\\nContent-Transfer-Encoding: 7bit\\r\\n\\r\\nplainText\\r\\n\\r\\n--PHP-alt-(.+)--\\r\\n$/';

        $this->assertSame(1, preg_match($pattern, $message->getMessageBody()));
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::setHtmlBody
     * @covers PitchBlade\Mail\Message::getMessageBody
     */
    public function testGetMessageBodyHtmlOnly()
    {
        $message = new Message(new Recipient('peehaa@php.net'), 'test');

        $message->setHtmlBody('<p>html</p>');

        $pattern = '/^--PHP-alt-(.+)\\r\\nContent-Type: text\/html; charset="iso-8859-1"\\r\\nContent-Transfer-Encoding: 7bit\\r\\n\\r\\n<p>html<\/p>\\r\\n\\r\\n--PHP-alt-(.+)--\\r\\n$/';

        $this->assertSame(1, preg_match($pattern, $message->getMessageBody()));
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::setPlainTextBody
     * @covers PitchBlade\Mail\Message::setHtmlBody
     * @covers PitchBlade\Mail\Message::getMessageBody
     */
    public function testGetMessageBothPlainTextAndHtml()
    {
        $message = new Message(new Recipient('peehaa@php.net'), 'test');

        $message->setPlainTextBody('plainText');
        $message->setHtmlBody('<p>html</p>');

        $pattern = '--PHP-alt-(.+)\\r\\nContent-Type: text\/plain; charset="iso-8859-1"\\r\\nContent-Transfer-Encoding: 7bit\\r\\n\\r\\nplainText\\r\\n\\r\\n';
        $pattern.= '--PHP-alt-(.+)\\r\\nContent-Type: text\/html; charset="iso-8859-1"\\r\\nContent-Transfer-Encoding: 7bit\\r\\n\\r\\n<p>html<\/p>\\r\\n\\r\\n';
        $pattern.= '--PHP-alt-(.+)--\\r\\n';

        $pattern = '/^' . $pattern . '$/';

        $this->assertSame(1, preg_match($pattern, $message->getMessageBody()));
    }
}
