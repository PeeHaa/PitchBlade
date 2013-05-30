<?php

namespace PitchBladeTest\Mocks\Mvc\View;

use PitchBlade\Mvc\View\View,
    PitchBlade\Mvc\View\Viewable,
    PitchBlade\Mvc\View\Builder,
    PitchBlade\Mvc\Model\ServiceBuilder,
    PitchBlade\I18n\Translator,
    PitchBlade\Router\UrlBuildable;

class MockViewWithoutData extends View implements Viewable
{
    public function __construct(
        Builder $viewFactory,
        ServiceBuilder $serviceFactory,
        Translator $translator,
        UrlBuildable $urlBuilder,
        $baseTemplate,
        $language
    )
    {
        parent::__construct($viewFactory, $serviceFactory, $translator, $urlBuilder, $baseTemplate, $language);
    }

    /**
     * Renders a template
     *
     * @param $template string The filename (including the path) of the template file to load
     *
     * @return string The rendered template
     * @throws \PitchBlade\Mvc\View\InvalidTemplateException When the template file could not be loaded
     */
    public function renderMock($template)
    {
        return $this->render($template);
    }

    /**
     * Renders a template
     *
     * @param $template string The filename (including the path) of the template file to load
     *
     * @return string The rendered template
     */
    public function renderPageMock($template)
    {
        return $this->renderPage($template);
    }

    public function renderHtml()
    {
        return $this->render(__DIR__ . '/../../../Data/Templates/partial.phtml');
    }
}
