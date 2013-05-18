<?php
/**
 * Interface for timed loggers
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

/**
 * Interface for timed loggers
 *
 * @category   PitchBlade
 * @package    Logging
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Timed
{
    /**
     * Starts the timer to log the current action
     *
     * @return int The unique identifier of the current log item
     */
    public function start();

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
    public function end($id, $type, $action);
}
