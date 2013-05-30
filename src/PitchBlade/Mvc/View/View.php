<?php
/**
 * Base class from which all views in the system should extend. This is to provide some basic functionality of views.
 *
 * Normally I don't like magic stuff (the setter/getters) in code, but in this specific case I think it's the only sane
 * thing to do. The only drawback to this approach is that we need to keep in mind that we don't try to overwrite real
 * members with magic members.
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Mvc
 * @subpackage View
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Mvc\View;

use PitchBlade\Mvc\View\Builder as ViewBuilder,
    PitchBlade\Mvc\Model\Servicebuilder,
    PitchBlade\I18n\Translator,
    PitchBlade\Router\UrlBuildable,
    PitchBlade\Mvc\View\InvalidBaseTemplateException,
    PitchBlade\Mvc\View\UndefinedVariableException,
    PitchBlade\Mvc\View\InvalidTemplateException;

/**
 * Base class from which all views in the system should extend. This is to provide some basic functionality of views.
 *
 * @category   PitchBlade
 * @package    Mvc
 * @subpackage View
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
abstract class View
{
    /**
     * @var \PitchBlade\Mvc\View\Builder Instance of the view builder
     */
    protected $viewFactory;

    /**
     * @var \PitchBlade\Mvc\Model\Servicebuilder Instance of the service builder
     */
    protected $serviceFactory;

    /**
     * @var \PitchBlade\I18n\Translator Instance of the translator service
     */
    protected $translator;

    /**
     * @var \PitchBlade\Router\UrlBuildable Instance of the URl builder
     */
    protected $urlBuilder;

    /**
     * @var string The base page in which all content will be loaded
     */
     protected $baseTemplate;

    /**
     * @var array The variables of the view to provide magic getters/setters
     */
    protected $variables = [];

    /**
     * @var string The currently used language
     */
    protected $language;

    /**
     * Creates instance of this view
     *
     * @param \PitchBlade\Mvc\View\Builder         $viewFactory    Instance of a view factory
     * @param \PitchBlade\Mvc\Model\Servicebuilder $serviceFactory Instance of a service factory
     * @param \PitchBlade\I18n\Translator          $translator     Instance of the translator service
     * @param \PitchBlade\Router\UrlBuildable      $urlBuilder     Instance of the URL builder
     * @param string                               $baseTemplate   The base page in which all content will be loaded
     * @param string                               $language       The currently used language
     */
    public function __construct(
        ViewBuilder $viewFactory,
        Servicebuilder $serviceFactory,
        Translator $translator,
        UrlBuildable $urlBuilder,
        $baseTemplate,
        $language
    )
    {
        $this->viewFactory    = $viewFactory;
        $this->serviceFactory = $serviceFactory;
        $this->translator     = $translator;
        $this->urlBuilder     = $urlBuilder;
        $this->baseTemplate   = $baseTemplate;
        $this->language       = $language;

        if (!file_exists($this->baseTemplate)) {
            throw new InvalidBaseTemplateException('Base template file (`' . $this->baseTemplate . '`) does not exist.');
        }
    }

    /**
     * Checks whether a view variable is set
     *
     * @param string $key The key under which to store the variable
     *
     * @return boolean Whether the view variable isset
     */
    public function __isset($key)
    {
        return isset($this->variables[$key]);
    }

    /**
     * Sets a view variable
     *
     * @param string $key   The key under which to store the variable
     * @param mixed  $value The value to store
     */
    public function __set($key, $value)
    {
        $this->variables[$key] = $value;
    }

    /**
     * Gets a view variable
     *
     * @param string $key The key of the variable to get
     *
     * @return mixed The value of the view variable
     * @throws \PitchBlade\Mvc\View\UndefinedVariableException When trying to access an undefined view variable
     */
    public function __get($key)
    {
        if (!array_key_exists($key, $this->variables)) {
            throw new UndefinedVariableException('Tried to access an undefined view variable with key `' . $key . '`.');
        }

        return $this->variables[$key];
    }

    /**
     * Renders a template
     *
     * @param $template string The filename (including the path) of the template file to load
     *
     * @return string The rendered template
     * @throws \PitchBlade\Mvc\View\InvalidTemplateException When the template file could not be loaded
     */
    protected function render($template)
    {
        if (!file_exists($template)) {
            throw new InvalidTemplateException('Template file (`' . $template . '`) does not exist.');
        }

        ob_start();
        require $template;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    /**
     * Renders a template
     *
     * @param $template string The filename (including the path) of the template file to load
     *
     * @return string The rendered template
     */
    protected function renderPage($template)
    {
        ob_start();
        $this->content = $this->render($template);
        require $this->baseTemplate;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    /**
     * Renders a (partial) view
     *
     * @param string $viewName The view to render
     * @param array  $data The optional extra data used to render the view
     *
     * @return string The rendered view
     */
    protected function renderView($viewName, array $data = [])
    {
        $view = $this->viewFactory->build($viewName);

        if (empty($data)) {
            return $view->renderHtml();
        }

        return $view->renderHtml($data);
    }

    /**
     * Get a translated string based on the current language and key
     *
     * @param string $key The item to translate
     *
     * @return string The translated string
     */
    protected function translate($key)
    {
        return $this->translator->get($key);
    }

    /**
     * Builds URLs
     *
     * @param string $name       The name of the route
     * @param array  $parameters The optional parameters to build the URL
     *
     * @return string The built URL
     */
    protected function buildUrl($name, array $parameters = [])
    {
        return $this->urlBuilder->build($name, $parameters);
    }
}
