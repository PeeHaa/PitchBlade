<?php

namespace PitchBladeTest\Mocks\Router\RequestMatcher;

class FalseMatcher
{
    public function doesMatch()
    {
        return false;
    }
}
