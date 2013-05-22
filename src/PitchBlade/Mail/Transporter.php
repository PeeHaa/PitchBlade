<?php
/**
 * Interface for classes that send mails
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
 * Interface for classes that send mails
 *
 * @category   PitchBlade
 * @package    Mail
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Transporter
{
    /**
     * Sends an email message
     *
     * @throws \PitchBlade\Mail\SendFailureException When something went wrong sending the email
     */
    public function send();
}
