<?php
/**
 * This interface represents a logger
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
namespace BareCMSLib\Logging;

/**
 * This interface represents a logger
 *
 * @category   PitchBlade
 * @package    Logging
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Logger
{
    /**
     * Logs an action
     *
     * @param string $type          The type of action which is being logged (e.g. PDO::query)
     * @param string $action        The specific action (e.g. 'SELECT * FROM table')
     * @param float  $executionTime The (optional) time in microseconds to run the action
     */
    public function log($type, $action, $executionTime = null);

    /**
     * Gets the entire list of all logged items
     *
     * @return array
     */
    public function report();
}
