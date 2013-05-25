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

use PitchBlade\Core\Autoloader,
    PitchBlade\Storage\Session,
    PitchBlade\Security\CsrfToken\StorageMedium\Session as CsrfTokenStorage,
    PitchBlade\Security\Generator\Factory as RandomGeneratorFactory,
    PitchBlade\Security\CsrfToken,
    PitchBlade\Http\Request,
    PitchBlade\I18n\Language\RecognizerFactory as LanguageRecognizerFactory,
    PitchBlade\I18n\TranslatorByFile;

/**
 * Bootstrap the PitchBlade library
 */
require_once __DIR__ . '/../../src/PitchBlade/bootstrap.php';

/**
 * Setup autoloader for the demo
 */
$autoloader = new Autoloader(__NAMESPACE__, dirname(__DIR__));
$autoloader->register();

/**
 * Start the session
 */
session_start();
$sessionStorage = new Session();

/**
 * Load the settings specific for the environment
 *
 * We are using `require`ing an external file here so we can easily switch
 * between production and development and/or other enviroments
 */
require_once __DIR__ . '/init.example.php';

/**
 * Setup the CSRF token
 */
$csrfTokenStorage = new CsrfTokenStorage('PitchBladeDemoCsrfToken', $sessionStorage);
$randomGeneratorFactory = new RandomGeneratorFactory();
$csrfToken = new CsrfToken($csrfTokenStorage, $randomGeneratorFactory);

/**
 * Setup the request object
 */
$request = new Request($_SERVER, $_GET, $_POST);

/**
 * Setup i18n
 */
$languageRecognizerFactory = new LanguageRecognizerFactory(['en'], $request);
$translator = new TranslatorByFile(__DIR__ . '/I18n', $languageRecognizerFactory->getLanguage());
