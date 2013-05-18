<?php

namespace PitchBladeTest\Mocks\Mvc\View;

use PitchBlade\Mvc\View\Builder;

class Factory implements Builder
{
    public function __construct()
    {
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
    }
}
