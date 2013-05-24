<?php

namespace PitchBladeTest\Unit\Acl;

use PitchBlade\Acl\Verifier,
    PitchBladeTest\Mocks\Storage\Session;;

class VerifierTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     */
    public function testConstructCorrectInterfaceWithSingleParam()
    {
        $verifier = new Verifier(new Session());

        $this->assertInstanceOf('\\PitchBlade\\Acl\\Verifiable', $verifier);
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     */
    public function testConstructCorrectInterfaceWithAllParams()
    {
        $verifier = new Verifier(new Session(), 'guestRole');

        $this->assertInstanceOf('\\PitchBlade\\Acl\\Verifiable', $verifier);
    }

    /**
     * @covers PitchBlade\Acl\Verifier::__construct
     * @covers PitchBlade\Acl\Verifier::addRoles
     */
    public function testAddRolesSuccess()
    {
        $verifier = new Verifier(new Session());

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
        $verifier = new Verifier(new Session());

        $this->setExpectedException('\\PitchBlade\\Acl\\MissingAccesslevelException');

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
        $verifier = new Verifier(new Session());

        $this->setExpectedException('\\PitchBlade\\Acl\\InvalidAccesslevelException');

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
        $verifier = new Verifier(new Session());

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
        $verifier = new Verifier(new Session());

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
        $verifier = new Verifier(new Session());

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
        $verifier = new Verifier(new Session(['user' => ['role' => 'user']]));

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
        $verifier = new Verifier(new Session(['user' => ['role' => 'user']]));

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
        $verifier = new Verifier(new Session(['user' => ['notRole' => 'user']]));

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
        $verifier = new Verifier(new Session(['user' => ['role' => 'invalidRole']]));

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
        $verifier = new Verifier(new Session(['user' => ['role' => 'user']]));

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
        $verifier = new Verifier(new Session());

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
        $verifier = new Verifier(new Session());

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
        $verifier = new Verifier(new Session(['user' => ['role' => 'user']]));

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
        $verifier = new Verifier(new Session(['user' => ['role' => 'user']]));

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
        $verifier = new Verifier(new Session(['user' => ['role' => 'user']]));

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
        $verifier = new Verifier(new Session(['user' => ['role' => 'admin']]));

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
        $verifier = new Verifier(new Session(['user' => ['role' => 'user']]));

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
        $verifier = new Verifier(new Session(['user' => ['role' => 'user']]));

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
        $verifier = new Verifier(new Session(['user' => ['role' => 'user']]));

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
        $verifier = new Verifier(new Session(['user' => ['role' => 'admin']]));

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
