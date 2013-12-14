<?php

namespace PitchBladeTest\Unit\Security\CsrfToken\StorageMedium;

use PitchBlade\Security\CsrfToken\StorageMedium\Session;

class SessionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Security\CsrfToken\StorageMedium\Session::__construct
     * @covers PitchBlade\Security\CsrfToken\StorageMedium\Session::set
     */
    public function testSet()
    {
        $session = new Session('somekey', $this->getMock('\\PitchBlade\\Storage\\SessionInterface'));

        $this->assertSame(null, $session->set('whatever'));
    }

    /**
     * @covers PitchBlade\Security\CsrfToken\StorageMedium\Session::__construct
     * @covers PitchBlade\Security\CsrfToken\StorageMedium\Session::get
     */
    public function testGetWithoutValue()
    {
        $sessionStorage = $this->getMock('\\PitchBlade\\Storage\\SessionInterface');
        $sessionStorage->expects($this->once())
            ->method('isKeyValid')
            ->will($this->returnValue(true));
        $sessionStorage->expects($this->once())
            ->method('get')
            ->will($this->returnValue(null));

        $session = new Session('somekey', $sessionStorage);

        $this->assertSame(null, $session->get());
    }

    /**
     * @covers PitchBlade\Security\CsrfToken\StorageMedium\Session::__construct
     * @covers PitchBlade\Security\CsrfToken\StorageMedium\Session::get
     */
    public function testGetWithoutValidKey()
    {
        $sessionStorage = $this->getMock('\\PitchBlade\\Storage\\SessionInterface');
        $sessionStorage->expects($this->once())
            ->method('isKeyValid')
            ->will($this->returnValue(false));

        $session = new Session('somekey', $sessionStorage);

        $this->assertSame(null, $session->get());
    }

    /**
     * @covers PitchBlade\Security\CsrfToken\StorageMedium\Session::__construct
     * @covers PitchBlade\Security\CsrfToken\StorageMedium\Session::set
     * @covers PitchBlade\Security\CsrfToken\StorageMedium\Session::get
     */
    public function testGetWithValue()
    {
        $sessionStorage = $this->getMock('\\PitchBlade\\Storage\\SessionInterface');
        $sessionStorage->expects($this->once())
            ->method('isKeyValid')
            ->will($this->returnValue(true));
        $sessionStorage->expects($this->once())
            ->method('get')
            ->will($this->returnValue('yay value'));

        $session = new Session('somekey', $sessionStorage);
        $session->set('yay value');

        $this->assertSame('yay value', $session->get());
    }
}
