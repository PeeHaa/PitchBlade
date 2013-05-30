<?php
/**
 * This class builds views on demand
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

use PitchBlade\Mvc\View\Builder,
    PitchBlade\Mvc\Model\ServiceBuilder,
    PitchBlade\I18n\Translator,
    PitchBlade\Router\UrlBuildable,
    PitchBlade\Mvc\View\InvalidViewException;

/**
 * This class builds views on demand
 *
 * @category   PitchBlade
 * @package    Mvc
 * @subpackage View
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Factory implements Builder
{
    /**
     * @var \PitchBlade\Mvc\Model\ServicesFactory Instance of the service factory
     */
    private $serviceFactory;

    /**
     * @var \PitchBlade\I18n\Translator Instance of the translation service
     */
    private $translator;

    /**
     * @var \PitchBlade\Router\UrlBuildable Instance of the URl builder
     */
    protected $urlBuilder;

    /**
     * @var string The base template
     */
    private $baseTemplate;

    /**
     * @var string The currently used language
     */
    private $language;

    /**
     * @var string The base namespace used to load views from
     */
    private $namespace;

    /**
     * Create instance. The supplied namespace will also be normalized to make it cleaner to handle later.
     * After normalization the namespace will look like \Name\Space\View\
     *
     * @param \PitchBlade\Mvc\Model\ServicesBuilder $serviceFactory Instance of the service factory
     * @param \PitchBlade\I18n\Translator           $translator     Instance of the translation service
     * @param string                                $baseTemplate   The base template
     * @param \PitchBlade\Router\UrlBuildable      $urlBuilder     Instance of the URL builder
     * @param string                                $language       The currently used language
     * @param string                                $namespace      The base namespace used to load views from. This is
     *                                                              useful when unit testing to easily be able to swap
     *                                                              for mocked views
     */
    public function __construct(
        ServiceBuilder $serviceFactory,
        Translator $translator,
        UrlBuildable $urlBuilder,
        $baseTemplate,
        $language,
        $namespace
    )
    {
        $this->serviceFactory = $serviceFactory;
        $this->translator     = $translator;
        $this->urlBuilder     = $urlBuilder;
        $this->baseTemplate   = $baseTemplate;
        $this->language       = $language;
        $this->namespace      = '\\' . trim($namespace, '\\') . '\\';
    }

    /**
     * Build and return an instance of the requested view
     *
     * @param string $view The view to load
     *
     * @return \PitchBlade\Mvc\View\Viewable The requested view object
     */
    public function build($view)
    {
        $viewClass = $view;
        if (strpos($view, '\\') !== 0) {
            $viewClass = $this->namespace . $viewClass;
        }

        if (!class_exists($viewClass)) {
            throw new InvalidViewException('Invalid view (`' . $viewClass . '`).');
        }

        return new $viewClass(
            $this,
            $this->serviceFactory,
            $this->translator,
            $this->urlBuilder,
            $this->baseTemplate,
            $this->language
        );
    }
}
