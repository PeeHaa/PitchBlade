<?php
/**
 * HTTP request object
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

use PitchBlade\Storage\ImmutableKeyValue;

/**
 * HTTP request object
 *
 * @category   PitchBlade
 * @package    Network
 * @subpackage Http
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Request implements RequestData
{
    /**
     * @var \PitchBlade\Storage\ImmutableKeyValue The path variables
     */
    private $pathVariables;

    /**
     * @var \PitchBlade\Storage\ImmutableKeyValue The GET variables
     */
    private $getVariables;

    /**
     * @var \PitchBlade\Storage\ImmutableKeyValue The POST variables
     */
    private $postVariables;

    /**
     * @var \PitchBlade\Storage\ImmutableKeyValue The SERVER variables
     */
    private $serverVariables;

    /**
     * @var \PitchBlade\Storage\ImmutableKeyValue The FILES variables
     */
    private $filesVariables;

    /**
     * @var \PitchBlade\Storage\ImmutableKeyValue The COOKIES variables
     */
    private $cookies;

    /**
     * @var array The URL path variables
     */
    private $paramVariables = [];

    /**
     * Creates instance
     *
     * @param \PitchBlade\Storage\ImmutableKeyValue $pathVariables    The path variables
     * @param \PitchBlade\Storage\ImmutableKeyValue $getVariables    The GET variables
     * @param \PitchBlade\Storage\ImmutableKeyValue $postVariables   The POST variables
     * @param \PitchBlade\Storage\ImmutableKeyValue $serverVariables The SERVER variables
     * @param \PitchBlade\Storage\ImmutableKeyValue $filesVariables  The FILES variables
     * @param \PitchBlade\Storage\ImmutableKeyValue $cookies         The COOKIE variables
     */
    public function __construct(
        ImmutableKeyValue $pathVariables,
        ImmutableKeyValue $getVariables,
        ImmutableKeyValue $postVariables,
        ImmutableKeyValue $serverVariables,
        ImmutableKeyValue $filesVariables,
        ImmutableKeyValue $cookies
    ) {
        $this->pathVariables   = $pathVariables;
        $this->getVariables    = $getVariables;
        $this->postVariables   = $postVariables;
        $this->serverVariables = $serverVariables;
        $this->filesVariables  = $filesVariables;
        $this->cookies         = $cookies;
    }

    /**
     * Gets all path values
     *
     * @return \Iterator All path values
     */
    public function pathIterator()
    {
        return $this->pathVariables;
    }

    /**
     * Gets all GET values
     *
     * @return \Iterator All GET values
     */
    public function getIterator()
    {
        return $this->getVariables;
    }

    /**
     * Gets all POST values
     *
     * @return \Iterator All POST values
     */
    public function postIterator()
    {
        return $this->postVariables;
    }

    /**
     * Gets all SERVER values
     *
     * @return \Iterator All SERVER values
     */
    public function serverIterator()
    {
        return $this->serverVariables;
    }

    /**
     * Gets all FILES values
     *
     * @return \Iterator All FILES values
     */
    public function filesIterator()
    {
        return $this->filesVariables;
    }

    /**
     * Gets all COOKIE values
     *
     * @return \Iterator All COOKIE values
     */
    public function cookiesIterator()
    {
        return $this->cookies;
    }

    /**
     * Gets a value from the path variables
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function path($key, $defaultValue = null)
    {
        return $this->pathVariables->get($key, $defaultValue);
    }

    /**
     * Gets a value from the GET variables
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function get($key, $defaultValue = null)
    {
        return $this->getVariables->get($key, $defaultValue);
    }

    /**
     * Gets a value from the POST variables
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function post($key, $defaultValue = null)
    {
        return $this->postVariables->get($key, $defaultValue);
    }

    /**
     * Gets a value from the SERVER variables
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function server($key, $defaultValue = null)
    {
        return $this->serverVariables->get($key, $defaultValue);
    }

    /**
     * Gets a value from the FILES variables
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function files($key, $defaultValue = null)
    {
        return $this->filesVariables->get($key, $defaultValue);
    }

    /**
     * Gets a value from the COOKIE variables
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function cookie($key, $defaultValue = null)
    {
        return $this->cookies->get($key, $defaultValue);
    }

    /**
     * Sets the parameters based on the URL path
     *
     * @param array $params The URL parameters
     */
    public function setParameters(array $params)
    {
        $this->paramVariables = $params;
    }

    /**
     * Gets a value fro the URL parameters
     *
     * @param string $key          The key of the value to get
     * @param mixed  $defaultValue The default value
     *
     * @return mixed The value
     */
    public function param($key, $defaultValue = null)
    {
        return array_key_exists($key, $this->paramVariables) ? $this->paramVariables[$key] : $defaultValue;
    }

    /**
     * Gets the requested path
     *
     * @return string The requested path
     */
    public function getPath()
    {
        return preg_replace('/\?.*/', '', $this->serverVariables->get('REQUEST_URI'));
    }

    /**
     * Gets the HTTP method used
     *
     * @return string The HTTP method used
     */
    public function getMethod()
    {
        return $this->server('REQUEST_METHOD');
    }

    /**
     * Checks whether the request is an XHR request
     *
     * When sending an xhr request clients should manually the `X-Requested-With` header.
     *
     * @return boolean True when it is an xhr request
     */
    public function isXhr()
    {
        return $this->serverVariables->get('HTTP_X_REQUESTED_WITH') === 'XMLHttpRequest';
    }

    /**
     * Checks whether the request is made over a secure (SSL/TLS) connection
     *
     * @return boolean True when the connection is secure
     */
    public function isSecure()
    {
        $https = $this->serverVariables->get('HTTPS');

        return (!empty($https) && $https !== 'off');
    }

    /**
     * Gets the base URL
     *
     * The base URL is build using the current protocol and hostname
     *
     * @return string The base URL
     */
    public function getBaseUrl()
    {
        $baseUrl = $this->isSecure() ? 'https://' : 'http://';

        return $baseUrl . $this->server('SERVER_NAME');
    }
}
