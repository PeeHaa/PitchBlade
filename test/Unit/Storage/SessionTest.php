<?php

use PitchBlade\Storage\Session;

class SessionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers \PitchBlade\Storage\Session::set
     */
    public function testSet()
    {
        $session = new Session();

        $this->assertNull($session->set('key', 'value'));
    }

    /**
     * @covers \PitchBlade\Storage\Session::set
     * @covers \PitchBlade\Storage\Session::isKeyValid
     * @covers \PitchBlade\Storage\Session::get
     */
    public function testGetValid()
    {
        $session = new Session();
        $session->set('key', 'value');

        $this->assertSame('value', $session->get('key'));
    }

    /**
     * @covers \PitchBlade\Storage\Session::set
     * @covers \PitchBlade\Storage\Session::isKeyValid
     * @covers \PitchBlade\Storage\Session::get
     */
    public function testGetInvalid()
    {
        $session = new Session();
        $this->setExpectedException('\\PitchBlade\\Storage\\InvalidKeyException');

        $session->get('key');
    }

    /**
     * @covers \PitchBlade\Storage\Session::isKeyValid
     */
    public function testIsKeyValidFail()
    {
        $session = new Session();

        $this->assertFalse(false, $session->isKeyValid('unknownkey'));
    }

    /**
     * @covers \PitchBlade\Storage\Session::set
     * @covers \PitchBlade\Storage\Session::isKeyValid
     */
    public function testIsKeyValidSuccess()
    {
        $session = new Session();
        $session->set('key', 'value');

        $this->assertTrue($session->isKeyValid('key'));
    }
}
