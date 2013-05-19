<?php

namespace PitchBladeTest\Mocks\Router\RequestMatcher;

class TrueMatcher
{
    public function doesMatch()
    {
        return true;
    }
}
