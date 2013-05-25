<?php
/**
 * This bootstraps the PitchBlade demo app
 *
 * PHP version 5.4
 *
 * @category   PitchBladeDemo
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBladeDemo;

use PitchBlade\Core\Autoloader;

/**
 * Bootstrap the PitchBlade library
 */
require_once __DIR__ . '/../../src/PitchBlade/bootstrap.php';

/**
 * Setup autoloader for the demo
 */
$autoloader = new Autoloader(__NAMESPACE__, dirname(__DIR__));
$autoloader->register();
