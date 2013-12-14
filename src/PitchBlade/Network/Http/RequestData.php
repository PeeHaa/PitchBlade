<?php
/**
 * HTTP request object interface
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Network
 * @subpackage Http
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Network\Http;

/**
 * HTTP request object interface
 *
 * @category   PitchBlade
 * @package    Network
 * @subpackage Http
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface RequestData
{
    /**
     * Gets all path values
     *
     * @return \Iterator All path values
     */
    public function pathIterator();

    /**
     * Gets all GET values
     *
     * @return \Iterator All GET values
     */
    public function getIterator();

    /**
     * Gets all POST values
     *
     * @return \Iterator All POST values
     */
    public function postIterator();

    /**
     * Gets all SERVER values
     *
     * @return \Iterator All SERVER values
     */
    public function serverIterator();

    /**
     * Gets all FILES values
     *
     * @return \Iterator All FILES values
     */
    public function filesIterator();

    /**
     * Gets all COOKIE values
     *
     * @return \Iterator All COOKIE values
     */
    public function cookiesIterator();

    /**
     * Gets a value from the path variables
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function path($key, $defaultValue = null);

    /**
     * Gets a value from the GET variables
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function get($key, $defaultValue = null);

    /**
     * Gets a value from the POST variables
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function post($key, $defaultValue = null);

    /**
     * Gets a value from the SERVER variables
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function server($key, $defaultValue = null);

    /**
     * Gets a value from the FILES variables
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function files($key, $defaultValue = null);

    /**
     * Gets a value from the COOKIE variables
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function cookie($key, $defaultValue = null);

    /**
     * Sets the parameters based on the URL path
     *
     * @param array $params The URL parameters
     */
    public function setParameters(array $params);

    /**
     * Gets a value fro the URL parameters
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function param($key, $defaultValue = null);

    /**
     * Gets the requested path
     *
     * @return string The requested path
     */
    public function getPath();

    /**
     * Gets the HTTP method used
     *
     * @return string The HTTP method used
     */
    public function getMethod();

    /**
     * Checks whether the request is an XHR request
     *
     * When sending an xhr request clients should manually the `X-Requested-With` header.
     *
     * @return boolean True when it is an xhr request
     */
    public function isXhr();

    /**
     * Checks whether the request is made over a secure (SSL/TLS) connection
     *
     * @return boolean True when the connection is secure
     */
    public function isSecure();

    /**
     * Gets the base URL
     *
     * The base URL is build using the current protocol and hostname
     *
     * @return string The base URL
     */
    public function getBaseUrl();
}
