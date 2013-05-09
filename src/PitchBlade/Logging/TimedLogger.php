<?php
/**
 * Provides a logger which has a start time and a end time
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
 * This interface represents a logger
 *
 * @category   PitchBlade
 * @package    Logging
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class TimedLogger
{
    /**
     * @var array List of the timed logs based on the unique identifiers
     */
    private $timedLogs = [];

    /**
     * @var \PitchBlade\Logging\Logger The logger
     */
    private $logger;

    /**
     * Creates instance
     *
     * @param \PitchBlade\Logging\Logger The logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Starts the timer to log the current action
     *
     * @return int The unique identifier of the current log item
     */
    public function start()
    {
        $uniqueIdentifier = uniqid('', true);

        $this->timedLogs[$uniqueIdentifier] = microtime(true);

        return $uniqueIdentifier;
    }

    /**
     * Ends the timer and logs the action
     *
     * @param int    $int    The unique identifier of the action to log
     * @param string $type   The type of action which is being logged (e.g. PDO::query)
     * @param string $action The specific action (e.g. 'SELECT * FROM table')
     *
     * @return int The time logged in microseconds
     * @throws \PitchBlade\Logging\UnknownTimedLogItemException When an unknown id is supplied
     */
    public function end($id, $type, $action)
    {
        if (!array_key_exists($id, $this->timedLogs)) {
            throw new UnknownTimedLogItemException(
                'The supplied id (`' . $id . '`) doesn\'t match with a running timed log'
            );
        }

        $executionTime = (microtime(true) - $this->timedLogs[$id]);

        $this->logger->log($type, $action, $executionTime);

        unset($this->timedLogs[$id]);

        return $executionTime;
    }
}
