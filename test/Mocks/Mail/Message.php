<?php

namespace PitchBladeTest\Mocks\Mail;

use PitchBlade\Mail\Deliverable,
    PitchBlade\Mail\Address;

class Message implements Deliverable
{
    private $data = [];

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     * Sets a custom reply-to address
     *
     * @param \PitchBlade\Mail\Recipient $address The reply-to address
     */
    public function setReplyTo(Address $address)
    {
    }

    /**
     * Adds a recipient emailaddress (to address)
     *
     * @param \PitchBlade\Mail\Address $address The recipient address
     */
    public function addRecipient(Address $address)
    {
    }

    /**
     * Gets all the recipients of the message
     *
     * @return array The recipients
     */
    public function getRecipients()
    {
        if (array_key_exists('recipients', $this->data)) {
            return $this->data['recipients'];
        }

        return [];
    }

    /**
     * Adds a CC emailaddress
     *
     * @param \PitchBlade\Mail\Recipient $address The recipient address
     */
    public function addCc(Address $address)
    {
    }

    /**
     * Adds a BCC emailaddress
     *
     * @param \PitchBlade\Mail\Recipient $address The recipient address
     */
    public function addBcc(Address $address)
    {
    }

    /**
     * Adds the plain text version of the body of the email
     *
     * @param string $text The text of the body
     */
    public function setPlainTextBody($text)
    {
    }

    /**
     * Adds the HTML version of the body of the email
     *
     * @param string $html The HTML of the body
     */
    public function setHtmlBody($html)
    {
    }

    /**
     * Gets the subject of the message
     *
     * @return string The subject
     */
    public function getSubject()
    {
        if (array_key_exists('subject', $this->data)) {
            return $this->data['subject'];
        }
    }

    /**
     * Builds the headers using all the options specified
     *
     * @return array The headers
     */
    public function getHeaders()
    {
        if (array_key_exists('headers', $this->data)) {
            return $this->data['headers'];
        }

        return [];
    }

    /**
     * Builds the mail body (the actual message to be send)
     *
     * return string The message body
     */
    public function getBody()
    {
    }
}
