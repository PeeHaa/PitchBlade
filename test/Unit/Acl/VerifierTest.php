<?php

namespace PitchBladeTest\Unit\Acl;

use PitchBlade\Acl\Verifier;

class VerifierTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     */
    public function testConstructCorrectInterfaceWithSingleParam()
    {
        $verifier = new Verifier(
            $this->getMock('\\PitchBlade\\Storage\\SessionInterface')
        );

        $this->assertInstanceOf('\\PitchBlade\\Acl\\Verifiable', $verifier);
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     */
    public function testConstructCorrectInterfaceWithAllParams()
    {
        $verifier = new Verifier(
            $this->getMock('\\PitchBlade\\Storage\\SessionInterface'),
            'guestRole'
        );

        $this->assertInstanceOf('\\PitchBlade\\Acl\\Verifiable', $verifier);
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     * @covers PitchBlade\Acl\Verifier::addRoles
     */
    public function testAddRolesSuccess()
    {
        $verifier = new Verifier(
            $this->getMock('\\PitchBlade\\Storage\\SessionInterface')
        );

        $this->assertNull($verifier->addRoles([
            'guest' => [
                'accesslevel' => 0,
            ],
        ]));
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     * @covers PitchBlade\Acl\Verifier::addRoles
     */
    public function testAddRolesMissingAccesslevel()
    {
        $verifier = new Verifier(
            $this->getMock('\\PitchBlade\\Storage\\SessionInterface')
        );

        $this->setExpectedException(
            '\\PitchBlade\\Acl\\MissingAccesslevelException'
        );

        $verifier->addRoles([
            'guest' => [
                'nonAccesslevel' => 0,
            ],
        ]);
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     * @covers PitchBlade\Acl\Verifier::addRoles
     */
    public function testAddRolesInvalidAccesslevel()
    {
        $verifier = new Verifier(
            $this->getMock('\\PitchBlade\\Storage\\SessionInterface')
        );

        $this->setExpectedException(
            '\\PitchBlade\\Acl\\InvalidAccesslevelException'
        );

        $verifier->addRoles([
            'guest' => [
                'accesslevel' => 'error',
            ],
        ]);
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     * @covers PitchBlade\Acl\Verifier::addRoles
     */
    public function testAddRolesMissingGuestRole()
    {
        $verifier = new Verifier(
            $this->getMock('\\PitchBlade\\Storage\\SessionInterface')
        );

        $this->setExpectedException('\\PitchBlade\\Acl\\MissingGuestException');

        $verifier->addRoles([
            'notGuest' => [
                'accesslevel' => 0,
            ],
        ]);
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     * @covers PitchBlade\Acl\Verifier::addRoles
     * @covers PitchBlade\Acl\Verifier::getUserRole
     * @covers PitchBlade\Acl\Verifier::doesRoleMatch
     */
    public function testGetUserRoleNotLoggedIn()
    {
        $verifier = new Verifier(
            $this->getMock('\\PitchBlade\\Storage\\SessionInterface')
        );

        $verifier->addRoles([
            'guest' => [
                'accesslevel' => 0,
            ],
            'user' => [
                'accesslevel' => 1,
            ],
        ]);

        $this->assertTrue($verifier->doesRoleMatch('guest'));
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     * @covers PitchBlade\Acl\Verifier::addRoles
     * @covers PitchBlade\Acl\Verifier::getUserRole
     * @covers PitchBlade\Acl\Verifier::doesRoleMatch
     */
    public function testGetUserRoleNotLoggedInGuestLast()
    {
        $verifier = new Verifier(
            $this->getMock('\\PitchBlade\\Storage\\SessionInterface')
        );

        $verifier->addRoles([
            'user' => [
                'accesslevel' => 1,
            ],
            'guest' => [
                'accesslevel' => 0,
            ],
        ]);

        $this->assertTrue($verifier->doesRoleMatch('guest'));
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     * @covers PitchBlade\Acl\Verifier::addRoles
     * @covers PitchBlade\Acl\Verifier::getUserRole
     * @covers PitchBlade\Acl\Verifier::doesRoleMatch
     */
    public function testGetUserRoleLoggedInWithRole()
    {
        $session = $this->getMock('\\PitchBlade\\Storage\\SessionInterface');
        $session->expects($this->once())
            ->method('isKeyValid')
            ->will($this->returnValue(true));
        $session->expects($this->once())
            ->method('get')
            ->will($this->returnValue(['role' => 'user']));

        $verifier = new Verifier($session);

        $verifier->addRoles([
            'guest' => [
                'accesslevel' => 0,
            ],
            'user' => [
                'accesslevel' => 1,
            ],
        ]);

        $this->assertTrue($verifier->doesRoleMatch('user'));
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     * @covers PitchBlade\Acl\Verifier::addRoles
     * @covers PitchBlade\Acl\Verifier::getUserRole
     * @covers PitchBlade\Acl\Verifier::doesRoleMatch
     */
    public function testGetUserRoleLoggedInWithRoleFirst()
    {
        $session = $this->getMock('\\PitchBlade\\Storage\\SessionInterface');
        $session->expects($this->once())
            ->method('isKeyValid')
            ->will($this->returnValue(true));
        $session->expects($this->once())
            ->method('get')
            ->will($this->returnValue(['role' => 'user']));

        $verifier = new Verifier($session);

        $verifier->addRoles([
            'user' => [
                'accesslevel' => 1,
            ],
            'guest' => [
                'accesslevel' => 0,
            ],
        ]);

        $this->assertTrue($verifier->doesRoleMatch('user'));
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     * @covers PitchBlade\Acl\Verifier::addRoles
     * @covers PitchBlade\Acl\Verifier::getUserRole
     * @covers PitchBlade\Acl\Verifier::doesRoleMatch
     */
    public function testGetUserRoleLoggedInWithoutRoleGuestFallback()
    {
        $session = $this->getMock('\\PitchBlade\\Storage\\SessionInterface');
        $session->expects($this->once())
            ->method('isKeyValid')
            ->will($this->returnValue(true));
        $session->expects($this->once())
            ->method('get')
            ->will($this->returnValue(['notRole' => 'user']));

        $verifier = new Verifier($session);

        $verifier->addRoles([
            'user' => [
                'accesslevel' => 1,
            ],
            'guest' => [
                'accesslevel' => 0,
            ],
        ]);

        $this->assertTrue($verifier->doesRoleMatch('guest'));
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     * @covers PitchBlade\Acl\Verifier::addRoles
     * @covers PitchBlade\Acl\Verifier::getUserRole
     * @covers PitchBlade\Acl\Verifier::doesRoleMatch
     */
    public function testGetUserRoleInvalidRole()
    {
        $session = $this->getMock('\\PitchBlade\\Storage\\SessionInterface');
        $session->expects($this->once())
            ->method('isKeyValid')
            ->will($this->returnValue(true));
        $session->expects($this->once())
            ->method('get')
            ->will($this->returnValue(['role' => 'invalidRole']));

        $verifier = new Verifier($session);

        $verifier->addRoles([
            'user' => [
                'accesslevel' => 1,
            ],
            'guest' => [
                'accesslevel' => 0,
            ],
        ]);

        $this->setExpectedException('\\PitchBlade\\Acl\\InvalidRoleException');

        $verifier->doesRoleMatch('guest');
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     * @covers PitchBlade\Acl\Verifier::addRoles
     * @covers PitchBlade\Acl\Verifier::getUserRole
     * @covers PitchBlade\Acl\Verifier::doesRoleMatch
     */
    public function testGetUserRoleLoggedInFromCache()
    {
        $session = $this->getMock('\\PitchBlade\\Storage\\SessionInterface');
        $session->expects($this->once())
            ->method('isKeyValid')
            ->will($this->returnValue(true));
        $session->expects($this->once())
            ->method('get')
            ->will($this->returnValue(['role' => 'user']));

        $verifier = new Verifier($session);

        $verifier->addRoles([
            'user' => [
                'accesslevel' => 1,
            ],
            'guest' => [
                'accesslevel' => 0,
            ],
        ]);

        $this->assertTrue($verifier->doesRoleMatch('user'));
        $this->assertTrue($verifier->doesRoleMatch('user'));
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     * @covers PitchBlade\Acl\Verifier::addRoles
     * @covers PitchBlade\Acl\Verifier::getUserRole
     * @covers PitchBlade\Acl\Verifier::getAccesslevelOfRole
     * @covers PitchBlade\Acl\Verifier::doesRoleMatchMinimumAccesslevel
     */
    public function testGetAccesslevelOfRole()
    {
        $verifier = new Verifier(
            $this->getMock('\\PitchBlade\\Storage\\SessionInterface')
        );

        $verifier->addRoles([
            'user' => [
                'accesslevel' => 1,
            ],
            'guest' => [
                'accesslevel' => 0,
            ],
        ]);

        $this->assertTrue($verifier->doesRoleMatchMinimumAccesslevel('guest'));
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     * @covers PitchBlade\Acl\Verifier::addRoles
     * @covers PitchBlade\Acl\Verifier::getUserRole
     * @covers PitchBlade\Acl\Verifier::getAccesslevelOfRole
     * @covers PitchBlade\Acl\Verifier::doesRoleMatchMinimumAccesslevel
     */
    public function testGetAccesslevelOfRoleInvalidRole()
    {
        $verifier = new Verifier(
            $this->getMock('\\PitchBlade\\Storage\\SessionInterface')
        );

        $verifier->addRoles([
            'user' => [
                'accesslevel' => 1,
            ],
            'guest' => [
                'accesslevel' => 0,
            ],
        ]);

        $this->setExpectedException('\\PitchBlade\\Acl\\InvalidRoleException');

        $verifier->doesRoleMatchMinimumAccesslevel('invalidRole');
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     * @covers PitchBlade\Acl\Verifier::addRoles
     * @covers PitchBlade\Acl\Verifier::doesRoleMatch
     */
    public function testDoesRoleMatchSuccess()
    {
        $session = $this->getMock('\\PitchBlade\\Storage\\SessionInterface');
        $session->expects($this->once())
            ->method('isKeyValid')
            ->will($this->returnValue(true));
        $session->expects($this->once())
            ->method('get')
            ->will($this->returnValue(['role' => 'user']));

        $verifier = new Verifier($session);

        $verifier->addRoles([
            'user' => [
                'accesslevel' => 1,
            ],
            'guest' => [
                'accesslevel' => 0,
            ],
        ]);

        $this->assertTrue($verifier->doesRoleMatch('user'));
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     * @covers PitchBlade\Acl\Verifier::addRoles
     * @covers PitchBlade\Acl\Verifier::getUserRole
     * @covers PitchBlade\Acl\Verifier::doesRoleMatch
     */
    public function testDoesRoleMatchFail()
    {
        $session = $this->getMock('\\PitchBlade\\Storage\\SessionInterface');
        $session->expects($this->once())
            ->method('isKeyValid')
            ->will($this->returnValue(true));
        $session->expects($this->once())
            ->method('get')
            ->will($this->returnValue(['role' => 'user']));

        $verifier = new Verifier($session);

        $verifier->addRoles([
            'user' => [
                'accesslevel' => 1,
            ],
            'guest' => [
                'accesslevel' => 0,
            ],
        ]);

        $this->assertFalse($verifier->doesRoleMatch('notUser'));
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     * @covers PitchBlade\Acl\Verifier::addRoles
     * @covers PitchBlade\Acl\Verifier::getUserRole
     * @covers PitchBlade\Acl\Verifier::getAccesslevelOfRole
     * @covers PitchBlade\Acl\Verifier::doesRoleMatchMinimumAccesslevel
     */
    public function testDoesRoleMatchMinimumAccesslevelSuccessExact()
    {
        $session = $this->getMock('\\PitchBlade\\Storage\\SessionInterface');
        $session->expects($this->once())
            ->method('isKeyValid')
            ->will($this->returnValue(true));
        $session->expects($this->once())
            ->method('get')
            ->will($this->returnValue(['role' => 'user']));

        $verifier = new Verifier($session);

        $verifier->addRoles([
            'user' => [
                'accesslevel' => 1,
            ],
            'guest' => [
                'accesslevel' => 0,
            ],
        ]);

        $this->assertTrue($verifier->doesRoleMatchMinimumAccesslevel('user'));
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     * @covers PitchBlade\Acl\Verifier::addRoles
     * @covers PitchBlade\Acl\Verifier::getUserRole
     * @covers PitchBlade\Acl\Verifier::getAccesslevelOfRole
     * @covers PitchBlade\Acl\Verifier::doesRoleMatchMinimumAccesslevel
     */
    public function testDoesRoleMatchMinimumAccesslevelSuccessGreater()
    {
        $session = $this->getMock('\\PitchBlade\\Storage\\SessionInterface');
        $session->expects($this->once())
            ->method('isKeyValid')
            ->will($this->returnValue(true));
        $session->expects($this->once())
            ->method('get')
            ->will($this->returnValue(['role' => 'admin']));

        $verifier = new Verifier($session);

        $verifier->addRoles([
            'user' => [
                'accesslevel' => 1,
            ],
            'guest' => [
                'accesslevel' => 0,
            ],
            'admin' => [
                'accesslevel' => 99,
            ],
        ]);

        $this->assertTrue($verifier->doesRoleMatchMinimumAccesslevel('user'));
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     * @covers PitchBlade\Acl\Verifier::addRoles
     * @covers PitchBlade\Acl\Verifier::getUserRole
     * @covers PitchBlade\Acl\Verifier::getAccesslevelOfRole
     * @covers PitchBlade\Acl\Verifier::doesRoleMatchMinimumAccesslevel
     */
    public function testDoesRoleMatchMinimumAccesslevelFail()
    {
        $session = $this->getMock('\\PitchBlade\\Storage\\SessionInterface');
        $session->expects($this->once())
            ->method('isKeyValid')
            ->will($this->returnValue(true));
        $session->expects($this->once())
            ->method('get')
            ->will($this->returnValue(['role' => 'user']));

        $verifier = new Verifier($session);

        $verifier->addRoles([
            'user' => [
                'accesslevel' => 1,
            ],
            'guest' => [
                'accesslevel' => 0,
            ],
            'admin' => [
                'accesslevel' => 99,
            ],
        ]);

        $this->assertFalse($verifier->doesRoleMatchMinimumAccesslevel('admin'));
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     * @covers PitchBlade\Acl\Verifier::addRoles
     * @covers PitchBlade\Acl\Verifier::getUserRole
     * @covers PitchBlade\Acl\Verifier::getAccesslevelOfRole
     * @covers PitchBlade\Acl\Verifier::doesRoleMatchMaximumAccesslevel
     */
    public function testDoesRoleMatchMaximumAccesslevelSuccessExact()
    {
        $session = $this->getMock('\\PitchBlade\\Storage\\SessionInterface');
        $session->expects($this->once())
            ->method('isKeyValid')
            ->will($this->returnValue(true));
        $session->expects($this->once())
            ->method('get')
            ->will($this->returnValue(['role' => 'user']));

        $verifier = new Verifier($session);

        $verifier->addRoles([
            'user' => [
                'accesslevel' => 1,
            ],
            'guest' => [
                'accesslevel' => 0,
            ],
        ]);

        $this->assertTrue($verifier->doesRoleMatchMaximumAccesslevel('user'));
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     * @covers PitchBlade\Acl\Verifier::addRoles
     * @covers PitchBlade\Acl\Verifier::getUserRole
     * @covers PitchBlade\Acl\Verifier::getAccesslevelOfRole
     * @covers PitchBlade\Acl\Verifier::doesRoleMatchMaximumAccesslevel
     */
    public function testDoesRoleMatchMaximumAccesslevelSuccessSmaller()
    {
        $session = $this->getMock('\\PitchBlade\\Storage\\SessionInterface');
        $session->expects($this->once())
            ->method('isKeyValid')
            ->will($this->returnValue(true));
        $session->expects($this->once())
            ->method('get')
            ->will($this->returnValue(['role' => 'user']));

        $verifier = new Verifier($session);

        $verifier->addRoles([
            'user' => [
                'accesslevel' => 1,
            ],
            'guest' => [
                'accesslevel' => 0,
            ],
            'admin' => [
                'accesslevel' => 99,
            ],
        ]);

        $this->assertTrue($verifier->doesRoleMatchMaximumAccesslevel('admin'));
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     * @covers PitchBlade\Acl\Verifier::addRoles
     * @covers PitchBlade\Acl\Verifier::getUserRole
     * @covers PitchBlade\Acl\Verifier::getAccesslevelOfRole
     * @covers PitchBlade\Acl\Verifier::doesRoleMatchMaximumAccesslevel
     */
    public function testDoesRoleMatchMaximumAccesslevelFail()
    {
        $session = $this->getMock('\\PitchBlade\\Storage\\SessionInterface');
        $session->expects($this->once())
            ->method('isKeyValid')
            ->will($this->returnValue(true));
        $session->expects($this->once())
            ->method('get')
            ->will($this->returnValue(['role' => 'admin']));

        $verifier = new Verifier($session);

        $verifier->addRoles([
            'user' => [
                'accesslevel' => 1,
            ],
            'guest' => [
                'accesslevel' => 0,
            ],
            'admin' => [
                'accesslevel' => 99,
            ],
        ]);

        $this->assertFalse($verifier->doesRoleMatchMaximumAccesslevel('user'));
    }
}
