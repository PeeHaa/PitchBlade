<?php
/**
 * This class represents a single route
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage Route
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Router\Route;

use PitchBlade\Router\Path\Parser;
use PitchBlade\Network\Http\RequestData;
use PitchBlade\Router\Path\Segment;

/**
 * This class represents a single route
 *
 * @category   PitchBlade
 * @package    Router
 * @subpackage Route
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Route implements AccessPoint
{
    /**
     * @var string The name of this route
     */
    private $name;

    /**
     * @var PitchBlade\Router\Path\Parser The path of the route
     */
    private $path;

    /**
     * @var callable The callback
     */
    private $callback;

    /**
     * @var array The (optional) requirements of path variables in the route
     */
    private $requirements = [];

    /**
     * @var array The (optional) mapping of path variable in the route
     */
    private $defaults = [];

    /**
     * @var array List of the path variables of the route
     */
    private $variables = [];

    /**
     * Creates the instance of the route
     *
     * @param string                        $name     The name of the route
     * @param PitchBlade\Router\Path\Parser $path     The path of the route
     * @param callable                      $callback The callback of the route
     */
    public function __construct($name, Parser $path, callable $callback)
    {
        $this->name     = $name;
        $this->path     = $path;
        $this->callback = $callback;
    }

    /**
     * Gets the name of the route
     *
     * @return string The name of the route
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the callback of the route
     *
     * @return callable The callback of the route
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * Adds a regex patterns as requirements for path variables
     *
     * @param array $requirements The regex patterns
     *
     * @return \PitchBlade\Router\Route\AccessPoint Instance of self
     */
    public function wherePattern(array $requirements)
    {
        $this->requirements = $requirements;

        return $this;
    }

    /**
     * Adds default values for path variables
     *
     * @param array $defaults The defaults
     *
     * @return \PitchBlade\Router\Route\AccessPoint Instance of self
     */
    public function defaults(array $defaults)
    {
        $this->defaults = $defaults;

        return $this;
    }

    /**
     * Tries to match the current route against the request
     *
     * @param \PitchBlade\Network\Http\RequestData $request The request data
     *
     * @return boolean True when the route matches the request
     */
    public function matchesRequest(RequestData $request)
    {
        $pathParts = explode('/', trim($request->getPath(), '/'));

        if (!$this->doesMatch($this->path->getParts(), $pathParts)) {
            return false;
        }

        $this->processVariables($this->path->getParts(), $pathParts);

        return true;
    }

    /**
     * Checks whether the request matches the route
     *
     * @param array $routeParts   The route parts
     * @param array $requestParts The request parts
     *
     * @return boolean True when the request matched the route
     */
    private function doesMatch(array $routeParts, array $requestParts)
    {
        if (count($requestParts) > count($routeParts)) {
            return false;
        }

        foreach ($routeParts as $index => $routePart) {
            if (!$routePart->isVariable() && !$this->doesStaticSegmentMatch($routePart, $requestParts, $index)) {
                return false;
            } else if (!$routePart->isOptional() && !$this->isRequiredSegmentSet($routePart, $requestParts, $index)) {
                return false;
            } else if ($routePart->isVariable() && !$this->areRequirementsMet($routePart, $requestParts, $index)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Checks whether the static segment matches
     *
     * @param \PitchBlade\Router\Path\Segment $routepart    The route part
     * @param array                           $requestParts The request parts
     * @param int                             $index        The current index
     *
     * @return boolean True when the static part matches
     */
    private function doesStaticSegmentMatch(Segment $routePart, array $requestParts, $index)
    {
        return isset($requestParts[$index]) && $routePart->getValue() === $requestParts[$index];
    }

    /**
     * Checks whether the required segment matches
     *
     * @param \PitchBlade\Router\Path\Segment $routepart    The route part
     * @param array                           $requestParts The request parts
     * @param int                             $index        The current index
     *
     * @return boolean True when the required segment matches
     */
    private function isRequiredSegmentSet(Segment $routePart, array $requestParts, $index)
    {
        return !empty($requestParts[$index]) || array_key_exists($routePart->getValue(), $this->defaults);
    }

    /**
     * Checks whether the requirements for the segment are met
     *
     * @param \PitchBlade\Router\Path\Segment $routepart    The route part
     * @param array                           $requestParts The request parts
     * @param int                             $index        The current index
     *
     * @return boolean True when the requirements match
     */
    private function areRequirementsMet(Segment $routePart, array $requestParts, $index)
    {
        if (!array_key_exists($routePart->getValue(), $this->requirements)) {
            return true;
        }

        return preg_match('/^' . $this->requirements[$routePart->getValue()] . '$/', $requestParts[$index]) === 1;
    }

    /**
     * Processes the variables in the URI path
     *
     * @param array $routeParts   The route parts
     * @param array $requestParts The request parts
     */
    private function processVariables(array $routeParts, array $requestParts)
    {
        foreach ($this->path->getParts() as $index => $pathPart) {
            if (!$pathPart->isVariable()) {
                continue;
            }

            $this->variables[$pathPart->getValue()] = $this->processVariable($pathPart, $requestParts, $index);
        }
    }

    /**
     * Processes a single URI path variable
     *
     * @param \PitchBlade\Router\Path\Segment $routepart    The route part
     * @param array                           $requestParts The request parts
     * @param int                             $index        The current index
     *
     * @return boolean True when the static part matches
     */
    private function processVariable(Segment $routePart, array $requestParts, $index)
    {
        if (isset($requestParts[$index])) {
            return $requestParts[$index];
        } else if (array_key_exists($routePart->getValue(), $this->defaults)) {
            return $this->defaults[$routePart->getValue()];
        }
    }
}
