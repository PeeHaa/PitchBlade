<?php

namespace PitchBladeTest\Mocks\Form\Field;

use PitchBlade\Form\Field\Generic;

class Dummy extends Generic
{
    public function __construct($name, array $data)
    {
        parent::__construct($name, $data);
    }

    public function setRawValue($data)
    {
    }

    public function isValid()
    {
        return true;
    }
}
