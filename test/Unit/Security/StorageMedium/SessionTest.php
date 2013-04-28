<?php

namespace PitchBladeTest\Unit\Security\StorageMedium;

use PitchBladeTest\Mocks\Storage\Session as SessionStorage,
    PitchBlade\Security\CsrfToken\StorageMedium\Session;

class SessionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Security\CsrfToken\StorageMedium\Session::__construct
     * @covers PitchBlade\Security\CsrfToken\StorageMedium\Session::set
     */
    public function testSet()
    {
        $session = new Session('somekey', new SessionStorage());

        $this->assertSame(null, $session->set('whatever'));
    }

    /**
     * @covers PitchBlade\Security\CsrfToken\StorageMedium\Session::__construct
     * @covers PitchBlade\Security\CsrfToken\StorageMedium\Session::get
     */
    public function testGetWithoutValue()
    {
        $session = new Session('somekey', new SessionStorage());

        $this->assertSame(null, $session->get());
    }

    /**
     * @covers PitchBlade\Security\CsrfToken\StorageMedium\Session::__construct
     * @covers PitchBlade\Security\CsrfToken\StorageMedium\Session::set
     * @covers PitchBlade\Security\CsrfToken\StorageMedium\Session::get
     */
    public function testGetWithValue()
    {
        $session = new Session('somekey', new SessionStorage());
        $session->set('yay value');

        $this->assertSame('yay value', $session->get());
    }
}
