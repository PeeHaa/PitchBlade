<?php
/**
 * Sends emails
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Mail
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Mail;

use PitchBlade\Mail\Transporter,
    PitchBlade\Mail\Deliverable,
    PitchBlade\Mail\SendFailureException,
    PitchBlade\Mail\MissingRecipientException;

/**
 * Sends emails
 *
 * @category   PitchBlade
 * @package    Mail
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Mailer implements Transporter
{
    /**
     * @var \PitchBlade\Mail\Deliverable The email message
     */
    private $message;

    /**
     * @var string Name of the mailer (X-Mailer header)
     */
    private $xMailerName;

    /**
     * Creates instance
     *
     * @param \PitchBlade\Mail\Deliverable $message     The email message to send
     * @param string                       $xMailerName Name of the mailer (X-Mailer header)
     */
    public function __construct(Deliverable $message, $xMailerName = 'PitchBlade Mailer')
    {
        $this->message     = $message;
        $this->xMailerName = $xMailerName;
    }

    /**
     * Sends an email message
     *
     * @throws \PitchBlade\Mail\SendFailureException When something went wrong sending the email
     */
    public function send()
    {
        if (!@mail($this->getRecipients(), $this->message->getSubject(), $this->message->getBody(), $this->getHeaders())) {
            throw new SendFailureException('The email (`' . $this->message->getSubject() . '`) could not be sent.');
        }
    }

    /**
     * `Gets the "to" address(es) to send the mails to
     *
     * The formatting of this string must comply with » RFC 2822. Some examples are:
     *
     * user@example.com
     * user@example.com, anotheruser@example.com
     * User <user@example.com>
     * User <user@example.com>, Another User <anotheruser@example.com>
     *
     * http://php.net/manual/en/function.mail.php
     *
     * @return string RFC 2822 address(es)
     * @throws \PitchBlade\Mail\MissingRecipientException When there is no recipient supplied for the message
     */
    private function getRecipients()
    {
        if (!count($this->message->getRecipients())) {
            throw new MissingRecipientException('Email messages need at least one recipient before being able to be send.');
        }

        $recipients = [];
        foreach ($this->message->getRecipients() as $recipient) {
            $recipients[] = $recipient->getRfcAddress();
        }

        return implode(', ', $recipients);
    }

    /**
     * Gets the message headers
     *
     * @return string The message headers
     */
    private function getHeaders()
    {
        $headers = $this->message->getHeaders();
        $headers['X-Mailer'] = $this->xMailerName;

        $formattedHeaders = '';
        foreach ($headers as $key => $value) {
            $formattedHeaders .= $key . ': ' . $value . "\r\n";
        }

        return rtrim($formattedHeaders);
    }
}
