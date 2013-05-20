<?php

namespace PitchBladeTest\Mocks\Mvc\Controller;

use PitchBlade\Http\RequestData;

class DummyController
{
    public function __construct(RequestData $request)
    {
    }

    public function testAction($view)
    {
        return 'TESTRESPONSE';
    }

    public function testActionWithDependency($view, $dependency)
    {
        return 'TESTRESPONSEDEPENDENCY';
    }
}
