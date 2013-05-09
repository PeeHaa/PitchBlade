<?php
/**
 * Logs items to an array
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Logging
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Logging;

use PitchBlade\Logging\Logger;

/**
 * Logs items to an array
 *
 * @category   PitchBlade
 * @package    Logging
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class ArrayLogger implements Logger
{
    /**
     * @var array The log
     */
    private $log = [];

    /**
     * @var string The format (based on PHP's date() format) of the log's timestamps
     */
    private $timestampFormat;

    /**
     * Creates instance
     *
     * @param string $timeStamp The format (based on PHP's date() format) of the log's timestamps
     */
    public function __construct($timestampFormat = 'd-m-Y H:i:s')
    {
        $this->timestampFormat = $timestampFormat;
    }

    /**
     * Logs an action
     *
     * @param string $type          The type of action which is being logged (e.g. PDO::query)
     * @param string $action        The specific action (e.g. 'SELECT * FROM table')
     * @param float  $executionTime The (optional) time in microseconds to run the action
     */
    public function log($type, $action, $executionTime = null)
    {
        $this->log[] = [
            'time'          => (new DateTime)->format('d-m-Y'),
            'type'          => $type,
            'action'        => $action,
            'executionTime' => $executionTime,
        ];
    }

    /**
     * Gets the entire list of all logged items
     *
     * @return array
     */
    public function report()
    {
        return $this->log;
    }
}
