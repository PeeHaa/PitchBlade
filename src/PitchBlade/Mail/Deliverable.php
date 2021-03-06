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

/**
 * Interface for mail messages
 *
 * @category   PitchBlade
 * @package    Mail
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Deliverable
{
    /**
     * Sets a custom reply-to address
     *
     * @param \PitchBlade\Mail\Recipient $address The reply-to address
     */
    public function setReplyTo(Address $address);

    /**
     * Adds a recipient emailaddress (to address)
     *
     * @param \PitchBlade\Mail\Address $address The recipient address
     */
    public function addRecipient(Address $address);

    /**
     * Gets all the recipients of the message
     *
     * @return array The recipients
     */
    public function getRecipients();

    /**
     * Adds a CC emailaddress
     *
     * @param \PitchBlade\Mail\Recipient $address The recipient address
     */
    public function addCc(Address $address);

    /**
     * Adds a BCC emailaddress
     *
     * @param \PitchBlade\Mail\Recipient $address The recipient address
     */
    public function addBcc(Address $address);

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
    public function setHtmlBody($html);

    /**
     * Gets the subject of the message
     *
     * @return string The subject
     */
    public function getSubject();

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
    public function getBody();
}
