<?php
/**
 * Setup error reporting
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 0);

/**
 * Setup timezone
 */
ini_set('date.timezone', 'Europe/Amsterdam');

/**
 * Setup the database connection
 */
$dbConnection = new \PDO('pgsql:dbname=pitchbladedemo;host=127.0.0.1', 'dbUsername', 'dbPassword');
$dbConnection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
$dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
$dbConnection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
