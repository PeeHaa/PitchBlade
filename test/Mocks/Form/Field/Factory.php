<?php

namespace PitchBladeTest\Mocks\Form\Field;

use PitchBlade\Form\Field\Builder;

class Factory implements Builder
{
    /**
     * Build field instance
     *
     * @param string $name The name of the field
     * @param array  $data The data to build the field
     *
     * @return \BareCMSLib\Form\Field\Generic The field
     */
    public function build($name, array $data = [])
    {
        return new \PitchBladeTest\Mocks\Form\Field\Dummy($name, $data);
    }
}
