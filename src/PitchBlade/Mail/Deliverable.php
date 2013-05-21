<?php
/**
 * Interface for mail messages
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

use PitchBlade\Mail\Recipient;

/**
 * Interface for mail messages
 *
 * @category   PitchBlade
 * @package    Mail
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Message implements Deliverable
{
    /**
     * Sets a custom reply-to address
     *
     * @param \PitchBlade\Mail\Recipient $address The reply-to address
     */
    public function setReplyTo(Recipient $address);

    /**
     * Adds a CC emailaddress
     *
     * @param \PitchBlade\Mail\Recipient $address The recipient address
     */
    public function addCc(Recipient $address);

    /**
     * Adds a BCC emailaddress
     *
     * @param \PitchBlade\Mail\Recipient $address The recipient address
     */
    public function addBcc(Recipient $address);

    /**
     * Adds the plain text version of the body of the email
     *
     * @param string $text The text of the body
     */
    public function setPlainTextBody($text);

    /**
     * Adds the HTML version of the body of the email
     *
     * @param string $html The HTML of the body
     */
    public function setBodyHtml($html);

    /**
     * Builds the headers using all the options specified
     *
     * @return array The headers
     */
    public function getHeaders();

    /**
     * Builds the mail body (the actual message to be send)
     *
     * return string The message body
     */
    public function getMessageBody();
}
