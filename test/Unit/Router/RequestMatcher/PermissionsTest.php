<?php

namespace PitchBladeTest\Unit\Router\RequestMatcher;

use PitchBlade\Router\RequestMatcher\Permissions;

class PermissionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     */
    public function testConstructCorrentInterface()
    {
        $matcher = new Permissions($this->getMock('\\PitchBlade\\Acl\\Verifiable'));

        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatcher\\Matchable', $matcher);
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchEmptyRequirements()
    {
        $matcher = new Permissions($this->getMock('\\PitchBlade\\Acl\\Verifiable'));

        $this->assertTrue($matcher->doesMatch([]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchNonMatchingRequirements()
    {
        $matcher = new Permissions($this->getMock('\\PitchBlade\\Acl\\Verifiable'));

        $this->assertTrue($matcher->doesMatch(['nonMatching' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchValid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatch')
            ->will($this->returnValue(true));

        $matcher = new Permissions($verifier);

        $this->assertTrue($matcher->doesMatch(['match' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchInvalid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatch')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['match' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMinimumValid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatchMinimumAccesslevel')
            ->will($this->returnValue(true));

        $matcher = new Permissions($verifier);

        $this->assertTrue($matcher->doesMatch(['minimum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMinimumInvalid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatchMinimumAccesslevel')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['minimum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMaximumValid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatchMaximumAccesslevel')
            ->will($this->returnValue(true));

        $matcher = new Permissions($verifier);

        $this->assertTrue($matcher->doesMatch(['maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMaximumInvalid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatchMaximumAccesslevel')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchValidAndMinimumValid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatch')
            ->will($this->returnValue(true));
        $verifier->expects($this->once())
            ->method('doesRoleMatchMinimumAccesslevel')
            ->will($this->returnValue(true));

        $matcher = new Permissions($verifier);

        $this->assertTrue($matcher->doesMatch(['match' => 1, 'minimum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchValidAndMinimumInvalid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatch')
            ->will($this->returnValue(true));
        $verifier->expects($this->once())
            ->method('doesRoleMatchMinimumAccesslevel')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['match' => 1, 'minimum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchInvalidAndMinimumValid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatch')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['match' => 1, 'minimum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchInvalidAndMinimumInvalid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatch')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['match' => 1, 'minimum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchValidAndMaximumValid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatch')
            ->will($this->returnValue(true));
        $verifier->expects($this->once())
            ->method('doesRoleMatchMaximumAccesslevel')
            ->will($this->returnValue(true));

        $matcher = new Permissions($verifier);

        $this->assertTrue($matcher->doesMatch(['match' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchValidAndMaximumInvalid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatch')
            ->will($this->returnValue(true));
        $verifier->expects($this->once())
            ->method('doesRoleMatchMaximumAccesslevel')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['match' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchInvalidAndMaximumValid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatch')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['match' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchInvalidAndMaximumInvalid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatch')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['match' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMinimumValidAndMatchValid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatchMinimumAccesslevel')
            ->will($this->returnValue(true));
        $verifier->expects($this->once())
            ->method('doesRoleMatch')
            ->will($this->returnValue(true));

        $matcher = new Permissions($verifier);

        $this->assertTrue($matcher->doesMatch(['minimum' => 1, 'match' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMinimumInvalidAndMatchValid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatchMinimumAccesslevel')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['minimum' => 1, 'match' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMinimumValidAndMatchInvalid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatchMinimumAccesslevel')
            ->will($this->returnValue(true));
        $verifier->expects($this->once())
            ->method('doesRoleMatch')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['minimum' => 1, 'match' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMinimumInvalidAndMatchInvalid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatchMinimumAccesslevel')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['minimum' => 1, 'match' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMinimumValidAndMaximumValid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatchMinimumAccesslevel')
            ->will($this->returnValue(true));
        $verifier->expects($this->once())
            ->method('doesRoleMatchMaximumAccesslevel')
            ->will($this->returnValue(true));

        $matcher = new Permissions($verifier);

        $this->assertTrue($matcher->doesMatch(['minimum' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMinimumInvalidAndMaximumValid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatchMinimumAccesslevel')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['minimum' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMinimumValidAndMaximumInvalid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatchMinimumAccesslevel')
            ->will($this->returnValue(true));
        $verifier->expects($this->once())
            ->method('doesRoleMatchMaximumAccesslevel')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['minimum' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMinimumInvalidAndMaximumInvalid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatchMinimumAccesslevel')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['minimum' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMaximumValidAndMatchValid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatchMaximumAccesslevel')
            ->will($this->returnValue(true));
        $verifier->expects($this->once())
            ->method('doesRoleMatch')
            ->will($this->returnValue(true));

        $matcher = new Permissions($verifier);

        $this->assertTrue($matcher->doesMatch(['maximum' => 1, 'match' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMaximumInvalidAndMatchValid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatchMaximumAccesslevel')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['maximum' => 1, 'match' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMaximumValidAndMatchInvalid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatchMaximumAccesslevel')
            ->will($this->returnValue(true));
        $verifier->expects($this->once())
            ->method('doesRoleMatch')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['maximum' => 1, 'match' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMaximumInvalidAndMatchInvalid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatchMaximumAccesslevel')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['maximum' => 1, 'match' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMaximumValidAndMinimumValid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatchMaximumAccesslevel')
            ->will($this->returnValue(true));
        $verifier->expects($this->once())
            ->method('doesRoleMatchMinimumAccesslevel')
            ->will($this->returnValue(true));

        $matcher = new Permissions($verifier);

        $this->assertTrue($matcher->doesMatch(['maximum' => 1, 'minimum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMaximumInvalidAndMinimumValid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatchMaximumAccesslevel')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['maximum' => 1, 'minimum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMaximumValidAndMinimumInvalid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatchMaximumAccesslevel')
            ->will($this->returnValue(true));
        $verifier->expects($this->once())
            ->method('doesRoleMatchMinimumAccesslevel')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['maximum' => 1, 'minimum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMaximumInvalidAndMinimumInvalid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatchMaximumAccesslevel')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['maximum' => 1, 'minimum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchValidAndMinimumValidAndMaximumValid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatch')
            ->will($this->returnValue(true));
        $verifier->expects($this->once())
            ->method('doesRoleMatchMinimumAccesslevel')
            ->will($this->returnValue(true));
        $verifier->expects($this->once())
            ->method('doesRoleMatchMaximumAccesslevel')
            ->will($this->returnValue(true));

        $matcher = new Permissions($verifier);

        $this->assertTrue($matcher->doesMatch(['match' => 1, 'minimum' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchInvalidAndMinimumValidAndMaximumValid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatch')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['match' => 1, 'minimum' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchValidAndMinimumInvalidAndMaximumValid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatch')
            ->will($this->returnValue(true));
        $verifier->expects($this->once())
            ->method('doesRoleMatchMinimumAccesslevel')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['match' => 1, 'minimum' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchValidAndMinimumValidAndMaximumInvalid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatch')
            ->will($this->returnValue(true));
        $verifier->expects($this->once())
            ->method('doesRoleMatchMinimumAccesslevel')
            ->will($this->returnValue(true));
        $verifier->expects($this->once())
            ->method('doesRoleMatchMaximumAccesslevel')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['match' => 1, 'minimum' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchInvalidAndMinimumInvalidAndMaximumValid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatch')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['match' => 1, 'minimum' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchInvalidAndMinimumInvalidAndMaximumInvalid()
    {
        $verifier = $this->getMock('\\PitchBlade\\Acl\\Verifiable');
        $verifier->expects($this->once())
            ->method('doesRoleMatch')
            ->will($this->returnValue(false));

        $matcher = new Permissions($verifier);

        $this->assertFalse($matcher->doesMatch(['match' => 1, 'minimum' => 1, 'maximum' => 1]));
    }
}
