<?php
/**
 * This class builds URLs based on a route name and optional arguments
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Router;

use PitchBlade\Router\UrlBuildable,
    PitchBlade\Router\Routable,
    PitchBlade\Router\AccessPoint;

/**
 * This class builds URLs based on a route name and optional arguments
 *
 * @category   PitchBlade
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class UrlBuilder implements UrlBuildable
{
    /**
     * @var \PitchBlade\Router\Routable The routes of the system
     */
    private $routes;

    /**
     * Creates instance
     *
     * @param \PitchBlade\Router\Routable $routes The routes of the system
     */
    public function __construct(Routable $routes)
    {
        $this->routes = $routes;
    }

    /**
     * Builds the URL based on the passed parameters and defaults
     *
     * @param string $name       The name of the route for which to build the URL
     * @param array  $parameters The optional parameters to build the URL with
     *
     * @return string The built URL
     * @throws \PicthBlade\Router\MissingUrlParameterException When missing URL parameters
     */
    public function build($name, array $parameters = [])
    {
        $route = $this->routes->getRouteByName($name);
        $pathParts = explode('/', ltrim($route->getPath(), '/'));

        $defaults = $route->getDefaults();
        if (!empty($defaults)) {
            $pathParts = $this->fillPath($route, $pathParts, $route->getDefaults());
        }

        if (!empty($parameters)) {
            $pathParts = $this->fillPath($route, $pathParts, $parameters);
        }

        $url = '/' . implode('/', $pathParts);

        if (strpos($url, ':') !== false) {
            throw new MissingUrlParameterException(
                'Missing parameter when trying to build url (`' . $url . '`) for route (`' . $name . '`).'
            );
        }

        return $url;
    }

    /**
     * Fills parts of the URL path with data
     *
     * @param \PitchBlade\Router\AccessPoint $route     The route for which to create the URL path
     * @param array                          $pathParts The parts of the URL path
     * @param array                          $data      The data to use to fill the path variables
     *
     * @return array The filled path parts
     */
    private function fillPath(AccessPoint $route, array $pathParts, array $data)
    {
        foreach ($data as $key => $value) {
            $positionInPath = array_search($key, $route->getPathVariables());
            if ($positionInPath === false) {
                continue;
            }

            if (!array_key_exists($positionInPath, $pathParts)) {
                continue;
            }

            $pathParts[$positionInPath] = $value;
        }

        return $pathParts;
    }
}
