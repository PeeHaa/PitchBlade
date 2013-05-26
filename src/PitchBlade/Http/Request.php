<?php
/**
 * Contains all the information of a HTTP request
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Http
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Http;

use PitchBlade\Http\RequestData;

/**
 * Contains all the information of a HTTP request
 *
 * @category   PitchBlade
 * @package    Http
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Request implements RequestData
{
    /**
     * @var array The server variables
     */
    private $serverVariables = [];

    /**
     * @var array The get variables
     */
    private $getVariables = [];

    /**
     * @var array The post variables
     */
    private $postVariables = [];

    /**
     * @var array The cookie variables
     */
    private $cookieVariables = [];

    /**
     * @var array The elements in the path
     */
    private $path = [];

    /**
     * @var array Maps elements in the path to variables
     */
    private $pathVariables = [];

    /**
     * Creates instance
     *
     * @param array $serverVariables The variables from the $_SERVER superglobal
     * @param array $getVariables    The variables from the $_GET superglobal
     * @param array $postVariables   The variables from the $_POST superglobal
     * @param array $cookieVariables The variables from the $_COOKIE superglobal
     */
    public function __construct(
        array $serverVariables,
        array $getVariables,
        array $postVariables,
        array $cookieVariables
    )
    {
        $this->serverVariables = $serverVariables;
        $this->getVariables    = $getVariables;
        $this->postVariables   = $postVariables;
        $this->cookieVariables = $cookieVariables;

        $this->setPath();
    }

    /**
     * Sets the path elements of the URI
     */
    private function setPath()
    {
        $barePath = $this->getBarePath();

        $this->path = explode('/', $barePath);
    }

    /**
     * Gets the bare path from the URI. All outer slashes will be stripped.
     *
     * @return string The bare path
     */
    private function getBarePath()
    {
        $currentPath = current(explode('?', $this->serverVariables['REQUEST_URI'], 2));

        return trim($currentPath, '/');
    }

    /**
     * Gets the path of the URI
     *
     * @return string The path
     */
    public function getPath()
    {
        return '/' . implode('/', $this->path);
    }

    /**
     * Sets up the mapping of path parts to request variables
     *
     * @param array $mapping The mapping from path parts to request variables
     */
    public function setPathVariables(array $mapping)
    {
        foreach ($mapping as $key => $pathPartIndex) {
            if (!array_key_exists($pathPartIndex, $this->path)) {
                continue;
            }

            $this->pathVariables[$key] = $this->path[$pathPartIndex];
        }
    }

    /**
     * Gets the get variables
     *
     * @return array The get variables
     */
    public function getGetVariables()
    {
        return $this->getVariables;
    }

    /**
     * Gets a get variable
     *
     * @return mixed The get variable value (or null if it doesn't exists)
     */
    public function getGetVariable($key, $defaultValue = null)
    {
        return (array_key_exists($key, $this->getVariables) ? $this->getVariables[$key] : $defaultValue);
    }

    /**
     * Gets the post variables
     *
     * @return array The post variables
     */
    public function getPostVariables()
    {
        return $this->postVariables;
    }

    /**
     * Gets a post variable
     *
     * @return mixed The post variable value (or null if it doesn't exists)
     */
    public function getPostVariable($key, $defaultValue = null)
    {
        return (array_key_exists($key, $this->postVariables) ? $this->postVariables[$key] : $defaultValue);
    }

    /**
     * Gets the cookie variables
     *
     * @return array The cookie variables
     */
    public function getCookieVariables()
    {
        return $this->cookieVariables;
    }

    /**
     * Gets a cookie variable
     *
     * @return mixed The cookie variable value (or null if it doesn't exists)
     */
    public function getCookieVariable($key, $defaultValue = null)
    {
        return (array_key_exists($key, $this->cookieVariables) ? $this->cookieVariables[$key] : $defaultValue);
    }

    /**
     * Gets the path variables
     *
     * @return array The path variables
     */
    public function getPathVariables()
    {
        return $this->pathVariables;
    }

    /**
     * Gets a path variable
     *
     * @return mixed The path variable value (or null if it doesn't exists)
     */
    public function getPathVariable($key, $defaultValue = null)
    {
        return (!empty($this->pathVariables[$key]) ? $this->pathVariables[$key] : $defaultValue);
    }

    /**
     * Gets the server variables
     *
     * @return array The server variables
     */
    public function getServerVariables()
    {
        return $this->serverVariables;
    }

    /**
     * Gets a server variable
     *
     * @return mixed The server variable value (or null if it doesn't exists)
     */
    public function getServerVariable($key, $defaultValue = null)
    {
        return (!empty($this->serverVariables[$key]) ? $this->serverVariables[$key] : $defaultValue);
    }

    /**
     * Gets the HTTP method
     *
     * @return string The HTTP method
     */
    public function getMethod()
    {
        return $this->serverVariables['REQUEST_METHOD'];
    }

    /**
     * Gets the host
     *
     * @return string The host
     */
    public function getHost()
    {
        return $this->serverVariables['HTTP_HOST'];
    }

    /**
     * Check whether the connection is over SSL
     *
     * @return boolean Whether the connection is over SSL
     */
    public function isSsl()
    {
        return !(empty($this->serverVariables['HTTPS']) || $this->serverVariables['HTTPS'] == 'off');
    }
}
