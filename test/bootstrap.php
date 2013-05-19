<?php
/**
 * Bootstrap the tests. This enables autoloading of mock classes and the library.
 *
 * PHP version 5.4
 *
 * @category   PitchBladeTest
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBladeTest;

date_default_timezone_set('Europe/Amsterdam');

session_start();

/**
 * Simple SPL autoloader for the PitchBladeTest libraries.
 *
 * @param string $class The class name to load
 *
 * @return void
 */
spl_autoload_register(function ($class) {
    $nslen = strlen(__NAMESPACE__);
    if (substr($class, 0, $nslen) != __NAMESPACE__) {
        return;
    }
    $path = substr(str_replace('\\', '/', $class), $nslen);
    $path = __DIR__ . $path . '.php';
    if (file_exists($path)) {
        require $path;
    }
});

/**
 * Set the data directory for test data
 */
define('PITCHBLADE_TEST_DATA_DIR', __DIR__ . '/Data');

/**
 * Simple function to easily get test data
 *
 * @param string $file Location of the file to load
 *
 * @return mixed The test data from the file
 */
function getTestDataFromFile($file) {
    return require $file;
}

/**
 * Function which provides database info so that we can easily switch between environments
 *
 * @return array List of database info including: dsn, user, pass and driver options
 */
function getDatabaseInfo()
{
    $databaseInfo = [
        'dsn' => 'pgsql:dbname=pitchblade_test;host=127.0.0.1',
        'username' => 'postgres',
        'password' => '',
        'driverOptions' => [
            \PDO::ATTR_EMULATE_PREPARES   => false,
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
        ],
    ];

    return $databaseInfo;
}

/**
 * Load the project's autoloader
 */
require_once __DIR__ . '/../src/PitchBlade/bootstrap.php';
