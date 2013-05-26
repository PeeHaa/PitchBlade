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
    PitchBlade\Logging\ArrayLogger,
    PitchBlade\Logging\TimedLogger,
    PitchBlade\Storage\Database\PDO,
    PitchBlade\Security\CsrfToken\StorageMedium\Session as CsrfTokenStorage,
    PitchBlade\Security\Generator\Factory as RandomGeneratorFactory,
    PitchBlade\Security\CsrfToken,
    PitchBlade\Http\Request,
    PitchBlade\I18n\LanguageRecognizer,
    PitchBlade\I18n\Language\RecognizerFactory as LanguageRecognizerFactory,
    PitchBlade\I18n\TranslatorByFile,
    PitchBlade\Acl\Verifier,
    PitchBlade\Router\RequestMatcher\Factory as RequestMatcherFactory,
    PitchBlade\Router\RequestMatcher,
    PitchBlade\Router\RouteFactory,
    PitchBlade\Router\Routes,
    PitchBlade\Router\RouteParser\ArrayParser as RoutesArrayParser,
    PitchBlade\Router\RouteParser\FileArrayParser as RoutesFileParser,
    PitchBlade\Mvc\Model\ServiceFactory,
    PitchBlade\Mvc\View\Factory as ViewFactory,
    PitchBlade\Form\Field\Factory as FormFieldFactory,
    PitchBlade\Router\FrontController;

/**
 * Get the start time so we can log the time it takes to handle the entire request
 *
 * Normally we would use the TimedLogger for this, but the library hasn't been bootstrapped yet
 */
$startTime = microtime(true);

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
 * Setup the loggers
 */
$logger = new ArrayLogger();
$timedLogger = new TimedLogger($logger);

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
$request = new Request($_SERVER, $_GET, $_POST, $_COOKIE);

/**
 * Setup i18n
 */
$languageRecognizerFactory = new LanguageRecognizerFactory(['en'], $request);
$languageRecognizer = new LanguageRecognizer($languageRecognizerFactory);
$translator = new TranslatorByFile(__DIR__ . '/I18n', $languageRecognizer->getLanguage());

/**
 * Setup ACL
 */
$aclVerifier = new Verifier($sessionStorage);

/**
 * Setup the routes of the system
 */
$requestMatcherFactory = new RequestMatcherFactory($request, $aclVerifier);
$requestMatcher = new RequestMatcher($requestMatcherFactory);
$routeFactory = new RouteFactory($requestMatcher);
$routes = new Routes($routeFactory);

$routesParser = new RoutesArrayParser($routes);
$routesFileParser = new RoutesFileParser($routesParser);
$routesFileParser->parse(__DIR__ . '/routes.php');

/**
 * Setup the view and service factories
 */
$serviceFactory = new ServiceFactory('PitchBladeDemo\\Models');
$viewfactory = new ViewFactory(
    $serviceFactory,
    $translator,
    __DIR__ . '/Templates/blocks/page.phtml',
    $languageRecognizer->getLanguage(),
    'PitchBladeDemo\Views'
);

/**
 * Dispatch the request
 */
$frontController = new FrontController($request, $routes, $viewfactory, new FormFieldFactory(), $csrfToken);
echo $frontController->dispatch();

/**
 * Log the entire request's execution time
 */
$logger->log('Handling request', $request->getServerVariable('REQUEST_URI'), (microtime(true)-$startTime));
