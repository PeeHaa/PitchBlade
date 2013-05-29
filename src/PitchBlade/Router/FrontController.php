<?php
/**
 * This class finds the route matching the request and loads all the needed objects to form a response
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Router;

use PitchBlade\Router\Routable,
    PitchBlade\Http\RequestData,
    PitchBlade\Mvc\View\Builder as ViewBuilder,
    PitchBlade\Form\Field\Builder as FieldBuilder,
    PitchBlade\Security\TokenGenerator;

/**
 * This class finds the route matching the request and loads all the needed objects to form a response
 *
 * @category   PitchBlade
 * @package    Router
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class FrontController
{
    /**
     * @var \PitchBlade\Http\RequestData The request
     */
    private $request;

    /**
     * @var \PitchBlade\Router\Routable The collection of all routes in the system
     */
    private $routes;

    /**
     * @var \PitchBlade\Mvc\View\Builder Factory to build views
     */
    private $viewFactory;

    /**
     * @var \PitchBlade\Form\Field\Builder The field factory
     */
    private $fieldFactory;

    /**
     * @var \PitchBlade\Security\TokenGenerator The CSRF token instance
     */
    private $csrfToken;

    /**
     * Creates the front controller instance
     *
     * @param \PitchBlade\Http\RequestData        $request      The request
     * @param \PitchBlade\Router\Routable         $routes       The collection of routes
     * @param \PitchBlade\Mvc\View\Builder        $viewFactory  The view builder
     * @param \PitchBlade\Form\Field\Builder      $fieldfactory The input field builder
     * @param \PitchBlade\Security\TokenGenerator $csrfToken    The CSRF token
     */
    public function __construct(
        RequestData $request,
        Routable $routes,
        ViewBuilder $viewFactory,
        FieldBuilder $fieldFactory,
        TokenGenerator $csrfToken
    )
    {
        $this->request      = $request;
        $this->routes       = $routes;
        $this->viewFactory  = $viewFactory;
        $this->fieldFactory = $fieldFactory;
        $this->csrfToken    = $csrfToken;
    }

    /**
     * Dispatches the request
     *
     * @todo Refactor the thing. And it probably is going to need a DiC.
     *
     * @return string The response
     */
    public function dispatch()
    {
        $route = $this->routes->getRouteByRequest($this->request);
        $pathVariables = $route->getPathVariables();

        if (!empty($pathVariables)) {
            $this->request->setPathVariables($route);
        }

        $view = $this->viewFactory->build($route->getView());

        $controller = $route->getController();
        $controllerInstance = new $controller($this->request);

        $dependencies = $route->getDependencies();
        if (empty($dependencies)) {
            return $controllerInstance->{$route->getAction()}($view);
        } else {
            $resolvedDependencies = [$view];
            foreach ($dependencies as $dependency) {
                $resolvedDependencies[] = new $dependency($this->fieldFactory, $this->csrfToken);
            }

            return call_user_func_array([$controllerInstance, $route->getAction()], $resolvedDependencies);
        }
    }
}
