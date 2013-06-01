<?php

namespace PitchBladeTest\Mocks\Mvc\Model;

use PitchBlade\Security\TokenGenerator;

class CsrfType
{
    public function __construct(TokenGenerator $csrfToken)
    {
    }
}