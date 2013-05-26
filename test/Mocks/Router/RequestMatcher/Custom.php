<?php

namespace PitchBladeTest\Mocks\Router\RequestMatcher;

use PitchBlade\Router\RequestMatcher\Matchable;

class Custom implements Matchable
{
    public function doesMatch($requirement)
    {
        return true;
    }
}
