<?php

use PitchBladeTest\Mocks\Security\CsrfToken\StorageMedium\Dummy,
    PitchBlade\Security\CsrfToken;

class CsrfTokenTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Security\CsrfToken::__construct
     * @covers PitchBlade\Security\CsrfToken::getToken
     * @covers PitchBlade\Security\CsrfToken::generateToken
     */
    public function testGetTokenNotInitialized()
    {
        $csrfToken = new CsrfToken(new Dummy());
        $token = $csrfToken->getToken();

        $this->assertInternalType('string', $token);
    }

    /**
     * @covers PitchBlade\Security\CsrfToken::__construct
     * @covers PitchBlade\Security\CsrfToken::getToken
     */
    public function testGetTokenInitialized()
    {
        $csrfToken = new CsrfToken(new Dummy('some value'));
        $token = $csrfToken->getToken();

        $this->assertStringStartsWith('some value', $token);
    }

    /**
     * @covers PitchBlade\Security\CsrfToken::__construct
     * @covers PitchBlade\Security\CsrfToken::getToken
     * @covers PitchBlade\Security\CsrfToken::generateToken
     * @covers PitchBlade\Security\CsrfToken::validate
     */
    public function testValidateGeneratedValid()
    {
        $csrfToken = new CsrfToken(new Dummy());
        $token = $csrfToken->getToken();

        $this->assertTrue($csrfToken->validate($token));
    }

    /**
     * @covers PitchBlade\Security\CsrfToken::__construct
     * @covers PitchBlade\Security\CsrfToken::getToken
     * @covers PitchBlade\Security\CsrfToken::generateToken
     * @covers PitchBlade\Security\CsrfToken::validate
     */
    public function testValidateGeneratedInvalid()
    {
        $csrfToken = new CsrfToken(new Dummy());
        $csrfToken->getToken();

        $this->assertFalse($csrfToken->validate('invalid'));
    }

    /**
     * @covers PitchBlade\Security\CsrfToken::__construct
     * @covers PitchBlade\Security\CsrfToken::getToken
     * @covers PitchBlade\Security\CsrfToken::validate
     */
    public function testValidateInitializedValid()
    {
        $csrfToken = new CsrfToken(new Dummy('some token'));

        $this->assertTrue($csrfToken->validate('some token'));
    }

    /**
     * @covers PitchBlade\Security\CsrfToken::__construct
     * @covers PitchBlade\Security\CsrfToken::getToken
     * @covers PitchBlade\Security\CsrfToken::validate
     */
    public function testValidateInitializedInvalid()
    {
        $csrfToken = new CsrfToken(new Dummy('some token'));
        $csrfToken->getToken();

        $this->assertFalse($csrfToken->validate('invalid'));
    }

    /**
     * @covers PitchBlade\Security\CsrfToken::__construct
     * @covers PitchBlade\Security\CsrfToken::regenerateToken
     */
    public function testRegenerateTokenSuccess()
    {
        $csrfToken = new CsrfToken(new Dummy());
        $oldToken = $csrfToken->getToken();
        $csrfToken->regenerateToken();
        $newToken = $csrfToken->getToken();

        $this->assertInternalType('string', $newToken);

        $this->assertTrue($oldToken !== $newToken);
        $this->assertTrue($oldToken != $newToken);
    }
}
