<?php

use PitchBlade\Storage\Session;

class SessionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers Session::set
     */
    public function testSet()
    {
        $session = new Session();

        $this->assertNull($session->set('key', 'value'));
    }

    /**
     * @covers Session::set
     * @covers Session::isKeyValid
     * @covers Session::get
     */
    public function testGetValid()
    {
        $session = new Session();
        $session->set('key', 'value');

        $this->assertSame('value', $session->get('key'));
    }

    /**
     * @covers Session::set
     * @covers Session::isKeyValid
     * @covers Session::get
     */
    public function testGetInvalid()
    {
        $session = new Session();
        $this->setExpectedException('\\PitchBlade\\Storage\\InvalidKeyException');

        $session->get('key');
    }

    /**
     * @covers Session::isKeyValid
     */
    public function testIsKeyValidFail()
    {
        $session = new Session();

        $this->assertFalse(false, $session->isKeyValid('unknownkey'));
    }

    /**
     * @covers Session::set
     * @covers Session::isKeyValid
     */
    public function testIsKeyValidSuccess()
    {
        $session = new Session();
        $session->set('key', 'value');

        $this->assertTrue($session->isKeyValid('key'));
    }
}
