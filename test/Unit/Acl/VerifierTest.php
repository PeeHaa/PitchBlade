<?php

namespace PitchBladeTest\Acl;

use PitchBlade\Acl\Verifier,
    PitchBladeTest\Mocks\Storage\Session;;

class VerifierTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Acl::__construct
     */
    public function testConstructCorrectInterfaceWithSingleParam()
    {
        $verifier = new Verifier(new Session());

        $this->assertInstanceOf('\\PitchBlade\\Acl\\Verifiable', $verifier);
    }

    /**
     * @covers PitchBlade\Acl::__construct
     */
    public function testConstructCorrectInterfaceWithAllParams()
    {
        $verifier = new Verifier(new Session(), 'guestRole');

        $this->assertInstanceOf('\\PitchBlade\\Acl\\Verifiable', $verifier);
    }

    /**
     * @covers PitchBlade\Acl::__construct
     * @covers PitchBlade\Acl::addRoles
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
     * @covers PitchBlade\Acl::__construct
     * @covers PitchBlade\Acl::addRoles
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
     * @covers PitchBlade\Acl::__construct
     * @covers PitchBlade\Acl::addRoles
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
     * @covers PitchBlade\Acl::__construct
     * @covers PitchBlade\Acl::addRoles
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
     * @covers PitchBlade\Acl::__construct
     * @covers PitchBlade\Acl::addRoles
     * @covers PitchBlade\Acl::getUserRole
     * @covers PitchBlade\Acl::doesRoleMatch
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
     * @covers PitchBlade\Acl::__construct
     * @covers PitchBlade\Acl::addRoles
     * @covers PitchBlade\Acl::getUserRole
     * @covers PitchBlade\Acl::doesRoleMatch
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
     * @covers PitchBlade\Acl::__construct
     * @covers PitchBlade\Acl::addRoles
     * @covers PitchBlade\Acl::getUserRole
     * @covers PitchBlade\Acl::doesRoleMatch
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
     * @covers PitchBlade\Acl::__construct
     * @covers PitchBlade\Acl::addRoles
     * @covers PitchBlade\Acl::getUserRole
     * @covers PitchBlade\Acl::doesRoleMatch
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
     * @covers PitchBlade\Acl::__construct
     * @covers PitchBlade\Acl::addRoles
     * @covers PitchBlade\Acl::getUserRole
     * @covers PitchBlade\Acl::doesRoleMatch
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
     * @covers PitchBlade\Acl::__construct
     * @covers PitchBlade\Acl::addRoles
     * @covers PitchBlade\Acl::getUserRole
     * @covers PitchBlade\Acl::doesRoleMatch
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
     * @covers PitchBlade\Acl::__construct
     * @covers PitchBlade\Acl::addRoles
     * @covers PitchBlade\Acl::getUserRole
     * @covers PitchBlade\Acl::doesRoleMatch
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
     * @covers PitchBlade\Acl::__construct
     * @covers PitchBlade\Acl::addRoles
     * @covers PitchBlade\Acl::getUserRole
     * @covers PitchBlade\Acl::getAccesslevelOfRole
     * @covers PitchBlade\Acl::doesRoleMatchMinimumAccesslevel
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
     * @covers PitchBlade\Acl::__construct
     * @covers PitchBlade\Acl::addRoles
     * @covers PitchBlade\Acl::getUserRole
     * @covers PitchBlade\Acl::getAccesslevelOfRole
     * @covers PitchBlade\Acl::doesRoleMatchMinimumAccesslevel
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
     * @covers PitchBlade\Acl::__construct
     * @covers PitchBlade\Acl::addRoles
     * @covers PitchBlade\Acl::doesRoleMatch
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
     * @covers PitchBlade\Acl::__construct
     * @covers PitchBlade\Acl::addRoles
     * @covers PitchBlade\Acl::getUserRole
     * @covers PitchBlade\Acl::doesRoleMatch
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
     * @covers PitchBlade\Acl::__construct
     * @covers PitchBlade\Acl::addRoles
     * @covers PitchBlade\Acl::getUserRole
     * @covers PitchBlade\Acl::getAccesslevelOfRole
     * @covers PitchBlade\Acl::doesRoleMatchMinimumAccesslevel
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
     * @covers PitchBlade\Acl::__construct
     * @covers PitchBlade\Acl::addRoles
     * @covers PitchBlade\Acl::getUserRole
     * @covers PitchBlade\Acl::getAccesslevelOfRole
     * @covers PitchBlade\Acl::doesRoleMatchMinimumAccesslevel
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
     * @covers PitchBlade\Acl::__construct
     * @covers PitchBlade\Acl::addRoles
     * @covers PitchBlade\Acl::getUserRole
     * @covers PitchBlade\Acl::getAccesslevelOfRole
     * @covers PitchBlade\Acl::doesRoleMatchMinimumAccesslevel
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
     * @covers PitchBlade\Acl::__construct
     * @covers PitchBlade\Acl::addRoles
     * @covers PitchBlade\Acl::getUserRole
     * @covers PitchBlade\Acl::getAccesslevelOfRole
     * @covers PitchBlade\Acl::doesRoleMatchMaximumAccesslevel
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
     * @covers PitchBlade\Acl::__construct
     * @covers PitchBlade\Acl::addRoles
     * @covers PitchBlade\Acl::getUserRole
     * @covers PitchBlade\Acl::getAccesslevelOfRole
     * @covers PitchBlade\Acl::doesRoleMatchMaximumAccesslevel
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
     * @covers PitchBlade\Acl::__construct
     * @covers PitchBlade\Acl::addRoles
     * @covers PitchBlade\Acl::getUserRole
     * @covers PitchBlade\Acl::getAccesslevelOfRole
     * @covers PitchBlade\Acl::doesRoleMatchMaximumAccesslevel
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
