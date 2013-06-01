<?php

namespace PitchBladeTest\Mocks\Mvc\Model;

use PitchBlade\Security\TokenGenerator,
    PitchBlade\Form\Field\Builder;

class CsrfAndFieldType
{
    public function __construct(TokenGenerator $csrfToken, Builder $factory)
    {
    }
}