<?php
/**
 * Represents an RFC 2822 emailaddress
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
 * Represents an RFC 2822 emailaddress
 *
 * @category   PitchBlade
 * @package    Mail
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Recipient implements Address
{
    /**
     * @var string The emailaddress
     */
    protected $address;

    /**
     * @var string The name
     */
    protected $name;

    /**
     * @var string The RFC 2822 name
     */
    protected $rfcString;

    /**
     * Creates instance
     *
     * @param string $address The emailaddress
     * @param string $name The name
     *
     * @throws \PitchBlade\Mail\InvalidAddressException When the supplied e-mailaddress is invalid
     */
    public function __construct($address, $name = null)
    {
        if (!filter_var($address, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidAddressException('The supplied e-mailaddress (`' . $address . '`) is not valid.');
        }

        $this->address = $address;
        $this->name    = $name;
    }

    /**
     * Gets the emailaddress
     *
     * @return string The emailaddress
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Gets the name
     *
     * @return null|string The name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the RFC 2822 string
     *
     * @return string The RFC 2822 address
     */
    public function getRfcAddress()
    {
        if ($this->name === null) {
            return $this->address;
        }

        return $this->name . ' <' . $this->address . '>';
    }
}
