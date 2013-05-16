<?php

namespace PitchBladeTest\Mocks\Mvc\View;

use PitchBlade\Mvc\View\Viewable,
    PitchBlade\Mvc\View\Builder,
    PitchBlade\Mvc\Model\ServiceBuilder,
    PitchBlade\I18n\Translator;

class DummyView implements Viewable
{
    public function __construct(
        Builder $viewFactory,
        ServiceBuilder $serviceFactory,
        Translator $translator,
        $baseTemplate
    )
    {
    }
}
