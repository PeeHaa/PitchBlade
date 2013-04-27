<?php
/**
 * Bootstrap the tests. This enables autoloading of mock classes and the library. It also provides a (global) function
 * to easily be able to load data.
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

require_once __DIR__ . '/../src/PitchBlade/bootstrap.php';
