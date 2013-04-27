<?php
/**
 * This bootstraps the `project
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade;

use PitchBlade\Core\Autoloader;

require_once __DIR__ . '/Core/Autoloader.php';

$autoloader = new Autoloader(__NAMESPACE__, dirname(__DIR__));
$autoloader->register();

require_once __DIR__ . '/Security/password_compat.php';
