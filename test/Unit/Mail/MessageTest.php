<?php

namespace PitchBladeTest\Unit\Mail;

use PitchBlade\Mail\Message;
//    PitchBlade\Mail\Recipient;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Mail\Message::__construct
     */
    public function testConstructCorrectInterfaceWithCharset()
    {
        $message = new Message($this->getMock('\\PitchBlade\\Mail\\Address'), 'test', 'utf-8');

        $this->assertInstanceOf('\\PitchBlade\\Mail\\Deliverable', $message);
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     */
    public function testConstructCorrectInterfaceWithoutCharset()
    {
        $message = new Message($this->getMock('\\PitchBlade\\Mail\\Address'), 'test');

        $this->assertInstanceOf('\\PitchBlade\\Mail\\Deliverable', $message);
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::setReplyTo
     */
    public function testSetReplyTo()
    {
        $message = new Message($this->getMock('\\PitchBlade\\Mail\\Address'), 'test');

        $this->assertNull($message->setReplyTo($this->getMock('\\PitchBlade\\Mail\\Address')));
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::addRecipient
     */
    public function testAddRecipient()
    {
        $message = new Message($this->getMock('\\PitchBlade\\Mail\\Address'), 'test');

        $this->assertNull($message->addRecipient($this->getMock('\\PitchBlade\\Mail\\Address')));
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::addRecipient
     * @covers PitchBlade\Mail\Message::getRecipients
     */
    public function testGetRecipients()
    {
        $message = new Message($this->getMock('\\PitchBlade\\Mail\\Address'), 'test');

        $this->assertNull($message->addRecipient($this->getMock('\\PitchBlade\\Mail\\Address')));
        $this->assertNull($message->addRecipient($this->getMock('\\PitchBlade\\Mail\\Address')));

        $recipients = $message->getRecipients();

        $this->assertSame(2, count($recipients));

        foreach ($recipients as $recipient) {
            $this->assertInstanceof('\\PitchBlade\\Mail\\Address', $recipient);
        }
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::addCc
     */
    public function testAddCc()
    {
        $message = new Message($this->getMock('\\PitchBlade\\Mail\\Address'), 'test');

        $this->assertNull($message->addCc($this->getMock('\\PitchBlade\\Mail\\Address')));
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::addBcc
     */
    public function testAddBcc()
    {
        $message = new Message($this->getMock('\\PitchBlade\\Mail\\Address'), 'test');

        $this->assertNull($message->addBcc($this->getMock('\\PitchBlade\\Mail\\Address')));
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::setPlainTextBody
     */
    public function testSetPlainTextBody()
    {
        $message = new Message($this->getMock('\\PitchBlade\\Mail\\Address'), 'test');

        $this->assertNull($message->setPlainTextBody('plainText'));
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::setHtmlBody
     */
    public function testSetHtmlBody()
    {
        $message = new Message($this->getMock('\\PitchBlade\\Mail\\Address'), 'test');

        $this->assertNull($message->setHtmlBody('<p>html</p>'));
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::getHeaders
     */
    public function testGetHeadersWithoutExtraRecipients()
    {
        $recipient = $this->getMock('\\PitchBlade\\Mail\\Address');
        $recipient->expects($this->any())
            ->method('getRfcAddress')
            ->will($this->returnValue('peehaa@php.net'));

        $message = new Message($recipient, 'test');

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
        $recipient = $this->getMock('\\PitchBlade\\Mail\\Address');
        $recipient->expects($this->any())
            ->method('getRfcAddress')
            ->will($this->returnValue('peehaa@php.net'));

        $message = new Message($recipient, 'test');

        $message->addCc($recipient);

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
        $recipient = $this->getMock('\\PitchBlade\\Mail\\Address');
        $recipient->expects($this->any())
            ->method('getRfcAddress')
            ->will($this->returnValue('peehaa@php.net'));

        $recipientPieter = $this->getMock('\\PitchBlade\\Mail\\Address');
        $recipientPieter->expects($this->any())
            ->method('getRfcAddress')
            ->will($this->returnValue('pieter@php.net'));

        $message = new Message($recipient, 'test');

        $message->addCc($recipient);
        $message->addCc($recipientPieter);

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
        $recipient = $this->getMock('\\PitchBlade\\Mail\\Address');
        $recipient->expects($this->any())
            ->method('getRfcAddress')
            ->will($this->returnValue('peehaa@php.net'));

        $message = new Message($recipient, 'test');

        $message->addBcc($recipient);

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
        $recipient = $this->getMock('\\PitchBlade\\Mail\\Address');
        $recipient->expects($this->any())
            ->method('getRfcAddress')
            ->will($this->returnValue('peehaa@php.net'));

        $recipientPieter = $this->getMock('\\PitchBlade\\Mail\\Address');
        $recipientPieter->expects($this->any())
            ->method('getRfcAddress')
            ->will($this->returnValue('pieter@php.net'));

        $message = new Message($recipient, 'test');

        $message->addBcc($recipient);
        $message->addBcc($recipientPieter);

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
        $recipient = $this->getMock('\\PitchBlade\\Mail\\Address');
        $recipient->expects($this->any())
            ->method('getRfcAddress')
            ->will($this->returnValue('peehaa@php.net'));

        $recipientPieter = $this->getMock('\\PitchBlade\\Mail\\Address');
        $recipientPieter->expects($this->any())
            ->method('getRfcAddress')
            ->will($this->returnValue('pieter@php.net'));

        $message = new Message($recipient, 'test');

        $message->addCc($recipient);
        $message->addBcc($recipientPieter);

        $this->assertSame('peehaa@php.net', $message->getHeaders()['From']);
        $this->assertSame('peehaa@php.net', $message->getHeaders()['Reply-To']);
        $this->assertSame(1, preg_match('/^multipart\/alternative; boundary="PHP-alt-(.+)"$/', $message->getHeaders()['Content-Type']));
        $this->assertSame('peehaa@php.net', $message->getHeaders()['Cc']);
        $this->assertSame('pieter@php.net', $message->getHeaders()['Bcc']);
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::getSubject
     */
    public function testGetSubject()
    {
        $recipient = $this->getMock('\\PitchBlade\\Mail\\Address');
        $recipient->expects($this->any())
            ->method('getRfcAddress')
            ->will($this->returnValue('peehaa@php.net'));

        $message = new Message($recipient, 'test');

        $this->assertSame('test', $message->getSubject());
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::setPlainTextBody
     * @covers PitchBlade\Mail\Message::getBody
     */
    public function testGetMessageBodyThrowsExceptionOnNoContent()
    {
        $recipient = $this->getMock('\\PitchBlade\\Mail\\Address');
        $recipient->expects($this->any())
            ->method('getRfcAddress')
            ->will($this->returnValue('peehaa@php.net'));

        $message = new Message($recipient, 'test');

        $this->setExpectedException('\\PitchBlade\\Mail\\MissingBodyException');

        $message->getBody();
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::setPlainTextBody
     * @covers PitchBlade\Mail\Message::getBody
     * @covers PitchBlade\Mail\Message::getBodyPart
     */
    public function testGetMessageBodyPlainTextOnly()
    {
        $recipient = $this->getMock('\\PitchBlade\\Mail\\Address');
        $recipient->expects($this->any())
            ->method('getRfcAddress')
            ->will($this->returnValue('peehaa@php.net'));

        $message = new Message($recipient, 'test');

        $message->setPlainTextBody('plainText');

        $pattern = '/^--PHP-alt-(.+)\\r\\nContent-Type: text\/plain; charset="iso-8859-1"\\r\\nContent-Transfer-Encoding: 7bit\\r\\n\\r\\nplainText\\r\\n\\r\\n--PHP-alt-(.+)--\\r\\n$/';

        $this->assertSame(1, preg_match($pattern, $message->getBody()));
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::setHtmlBody
     * @covers PitchBlade\Mail\Message::getBody
     * @covers PitchBlade\Mail\Message::getBodyPart
     */
    public function testGetMessageBodyHtmlOnly()
    {
        $recipient = $this->getMock('\\PitchBlade\\Mail\\Address');
        $recipient->expects($this->any())
            ->method('getRfcAddress')
            ->will($this->returnValue('peehaa@php.net'));

        $message = new Message($recipient, 'test');

        $message->setHtmlBody('<p>html</p>');

        $pattern = '/^--PHP-alt-(.+)\\r\\nContent-Type: text\/html; charset="iso-8859-1"\\r\\nContent-Transfer-Encoding: 7bit\\r\\n\\r\\n<p>html<\/p>\\r\\n\\r\\n--PHP-alt-(.+)--\\r\\n$/';

        $this->assertSame(1, preg_match($pattern, $message->getBody()));
    }

    /**
     * @covers PitchBlade\Mail\Message::__construct
     * @covers PitchBlade\Mail\Message::setPlainTextBody
     * @covers PitchBlade\Mail\Message::setHtmlBody
     * @covers PitchBlade\Mail\Message::getBody
     * @covers PitchBlade\Mail\Message::getBodyPart
     */
    public function testGetMessageBothPlainTextAndHtml()
    {
        $recipient = $this->getMock('\\PitchBlade\\Mail\\Address');
        $recipient->expects($this->any())
            ->method('getRfcAddress')
            ->will($this->returnValue('peehaa@php.net'));

        $message = new Message($recipient, 'test');

        $message->setPlainTextBody('plainText');
        $message->setHtmlBody('<p>html</p>');

        $pattern = '--PHP-alt-(.+)\\r\\nContent-Type: text\/plain; charset="iso-8859-1"\\r\\nContent-Transfer-Encoding: 7bit\\r\\n\\r\\nplainText\\r\\n\\r\\n';
        $pattern.= '--PHP-alt-(.+)\\r\\nContent-Type: text\/html; charset="iso-8859-1"\\r\\nContent-Transfer-Encoding: 7bit\\r\\n\\r\\n<p>html<\/p>\\r\\n\\r\\n';
        $pattern.= '--PHP-alt-(.+)--\\r\\n';

        $pattern = '/^' . $pattern . '$/';

        $this->assertSame(1, preg_match($pattern, $message->getBody()));
    }
}
