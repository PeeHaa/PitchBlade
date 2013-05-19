<?php

namespace PitchBladeTest\Unit\Router\RequestMatcher;

use PitchBlade\Router\RequestMatcher\Permissions,
    PitchBladeTest\Mocks\Acl\Verifier;

class PermissionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     */
    public function testConstructCorrentInterface()
    {
        $matcher = new Permissions(new Verifier([]));

        $this->assertInstanceOf('\\PitchBlade\\Router\\RequestMatcher\\Matchable', $matcher);
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchEmptyRequirements()
    {
        $matcher = new Permissions(new Verifier([]));

        $this->assertTrue($matcher->doesMatch([]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchNonMatchingRequirements()
    {
        $matcher = new Permissions(new Verifier([]));

        $this->assertTrue($matcher->doesMatch(['nonMatching' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchValid()
    {
        $matcher = new Permissions(new Verifier(['match' => true]));

        $this->assertTrue($matcher->doesMatch(['match' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchInvalid()
    {
        $matcher = new Permissions(new Verifier(['match' => false]));

        $this->assertFalse($matcher->doesMatch(['match' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMinimumValid()
    {
        $matcher = new Permissions(new Verifier(['minimum' => true]));

        $this->assertTrue($matcher->doesMatch(['minimum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMinimumInvalid()
    {
        $matcher = new Permissions(new Verifier(['minimum' => false]));

        $this->assertFalse($matcher->doesMatch(['minimum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMaximumValid()
    {
        $matcher = new Permissions(new Verifier(['maximum' => true]));

        $this->assertTrue($matcher->doesMatch(['maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMaximumInvalid()
    {
        $matcher = new Permissions(new Verifier(['maximum' => false]));

        $this->assertFalse($matcher->doesMatch(['maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchValidAndMinimumValid()
    {
        $matcher = new Permissions(new Verifier(['match' => true, 'minimum' => true]));

        $this->assertTrue($matcher->doesMatch(['match' => 1, 'minimum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchValidAndMinimumInvalid()
    {
        $matcher = new Permissions(new Verifier(['match' => true, 'minimum' => false]));

        $this->assertFalse($matcher->doesMatch(['match' => 1, 'minimum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchInvalidAndMinimumValid()
    {
        $matcher = new Permissions(new Verifier(['match' => false, 'minimum' => true]));

        $this->assertFalse($matcher->doesMatch(['match' => 1, 'minimum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchInvalidAndMinimumInvalid()
    {
        $matcher = new Permissions(new Verifier(['match' => false, 'minimum' => false]));

        $this->assertFalse($matcher->doesMatch(['match' => 1, 'minimum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchValidAndMaximumValid()
    {
        $matcher = new Permissions(new Verifier(['match' => true, 'maximum' => true]));

        $this->assertTrue($matcher->doesMatch(['match' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchValidAndMaximumInvalid()
    {
        $matcher = new Permissions(new Verifier(['match' => true, 'maximum' => false]));

        $this->assertFalse($matcher->doesMatch(['match' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchInvalidAndMaximumValid()
    {
        $matcher = new Permissions(new Verifier(['match' => false, 'maximum' => true]));

        $this->assertFalse($matcher->doesMatch(['match' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchInvalidAndMaximumInvalid()
    {
        $matcher = new Permissions(new Verifier(['match' => false, 'maximum' => false]));

        $this->assertFalse($matcher->doesMatch(['match' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMinimumValidAndMatchValid()
    {
        $matcher = new Permissions(new Verifier(['minimum' => true, 'match' => true]));

        $this->assertTrue($matcher->doesMatch(['minimum' => 1, 'match' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMinimumInvalidAndMatchValid()
    {
        $matcher = new Permissions(new Verifier(['minimum' => false, 'match' => true]));

        $this->assertFalse($matcher->doesMatch(['minimum' => 1, 'match' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMinimumValidAndMatchInvalid()
    {
        $matcher = new Permissions(new Verifier(['minimum' => true, 'match' => false]));

        $this->assertFalse($matcher->doesMatch(['minimum' => 1, 'match' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMinimumInvalidAndMatchInvalid()
    {
        $matcher = new Permissions(new Verifier(['minimum' => false, 'match' => false]));

        $this->assertFalse($matcher->doesMatch(['minimum' => 1, 'match' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMinimumValidAndMaximumValid()
    {
        $matcher = new Permissions(new Verifier(['minimum' => true, 'maximum' => true]));

        $this->assertTrue($matcher->doesMatch(['minimum' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMinimumInvalidAndMaximumValid()
    {
        $matcher = new Permissions(new Verifier(['minimum' => false, 'maximum' => true]));

        $this->assertFalse($matcher->doesMatch(['minimum' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMinimumValidAndMaximumInvalid()
    {
        $matcher = new Permissions(new Verifier(['minimum' => true, 'maximum' => false]));

        $this->assertFalse($matcher->doesMatch(['minimum' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMinimumInvalidAndMaximumInvalid()
    {
        $matcher = new Permissions(new Verifier(['minimum' => false, 'maximum' => false]));

        $this->assertFalse($matcher->doesMatch(['minimum' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMaximumValidAndMatchValid()
    {
        $matcher = new Permissions(new Verifier(['maximum' => true, 'match' => true]));

        $this->assertTrue($matcher->doesMatch(['maximum' => 1, 'match' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMaximumInvalidAndMatchValid()
    {
        $matcher = new Permissions(new Verifier(['maximum' => false, 'match' => true]));

        $this->assertFalse($matcher->doesMatch(['maximum' => 1, 'match' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMaximumValidAndMatchInvalid()
    {
        $matcher = new Permissions(new Verifier(['maximum' => true, 'match' => false]));

        $this->assertFalse($matcher->doesMatch(['maximum' => 1, 'match' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMaximumInvalidAndMatchInvalid()
    {
        $matcher = new Permissions(new Verifier(['maximum' => false, 'match' => false]));

        $this->assertFalse($matcher->doesMatch(['maximum' => 1, 'match' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMaximumValidAndMinimumValid()
    {
        $matcher = new Permissions(new Verifier(['maximum' => true, 'minimum' => true]));

        $this->assertTrue($matcher->doesMatch(['maximum' => 1, 'minimum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMaximumInvalidAndMinimumValid()
    {
        $matcher = new Permissions(new Verifier(['maximum' => false, 'minimum' => true]));

        $this->assertFalse($matcher->doesMatch(['maximum' => 1, 'minimum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMaximumValidAndMinimumInvalid()
    {
        $matcher = new Permissions(new Verifier(['maximum' => true, 'minimum' => false]));

        $this->assertFalse($matcher->doesMatch(['maximum' => 1, 'minimum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMaximumInvalidAndMinimumInvalid()
    {
        $matcher = new Permissions(new Verifier(['maximum' => false, 'minimum' => false]));

        $this->assertFalse($matcher->doesMatch(['maximum' => 1, 'minimum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchValidAndMinimumValidAndMaximumValid()
    {
        $matcher = new Permissions(new Verifier(['match' => true, 'minimum' => true, 'maximum' => true]));

        $this->assertTrue($matcher->doesMatch(['match' => 1, 'minimum' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchInvalidAndMinimumValidAndMaximumValid()
    {
        $matcher = new Permissions(new Verifier(['match' => false, 'minimum' => true, 'maximum' => true]));

        $this->assertFalse($matcher->doesMatch(['match' => 1, 'minimum' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchValidAndMinimumInvalidAndMaximumValid()
    {
        $matcher = new Permissions(new Verifier(['match' => true, 'minimum' => false, 'maximum' => true]));

        $this->assertFalse($matcher->doesMatch(['match' => 1, 'minimum' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchValidAndMinimumValidAndMaximumInvalid()
    {
        $matcher = new Permissions(new Verifier(['match' => true, 'minimum' => true, 'maximum' => false]));

        $this->assertFalse($matcher->doesMatch(['match' => 1, 'minimum' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchInvalidAndMinimumInvalidAndMaximumValid()
    {
        $matcher = new Permissions(new Verifier(['match' => false, 'minimum' => false, 'maximum' => true]));

        $this->assertFalse($matcher->doesMatch(['match' => 1, 'minimum' => 1, 'maximum' => 1]));
    }

    /**
     * @covers PitchBlade\Router\RequestMatcher\Permissions::__construct
     * @covers PitchBlade\Router\RequestMatcher\Permissions::doesMatch
     */
    public function testDoesMatchMatchInvalidAndMinimumInvalidAndMaximumInvalid()
    {
        $matcher = new Permissions(new Verifier(['match' => false, 'minimum' => false, 'maximum' => false]));

        $this->assertFalse($matcher->doesMatch(['match' => 1, 'minimum' => 1, 'maximum' => 1]));
    }
}
