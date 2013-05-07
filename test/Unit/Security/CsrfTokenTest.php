<?php

namespace PitchBladeTest\Unit\Security;

use PitchBladeTest\Mocks\Security\CsrfToken\StorageMedium\Dummy,
    PitchBlade\Security\CsrfToken,
    PitchBlade\Security\Generator\Factory;

class CsrfTokenTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Security\CsrfToken::__construct
     * @covers PitchBlade\Security\CsrfToken::getToken
     * @covers PitchBlade\Security\CsrfToken::generateToken
     */
    public function testGetTokenNotInitialized()
    {
        $csrfToken = new CsrfToken(new Dummy(), new Factory(), ['\\PitchBladeTest\\Mocks\\Security\\Generator\\Fake']);
        $token = $csrfToken->getToken();

        $this->assertInternalType('string', $token);
    }

    /**
     * @covers PitchBlade\Security\CsrfToken::__construct
     * @covers PitchBlade\Security\CsrfToken::getToken
     */
    public function testGetTokenInitialized()
    {
        $csrfToken = new CsrfToken(new Dummy('some value'), new Factory(), ['\\PitchBladeTest\\Mocks\\Security\\Generator\\Fake']);
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
        $csrfToken = new CsrfToken(new Dummy(), new Factory(), ['\\PitchBladeTest\\Mocks\\Security\\Generator\\Fake']);
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
        $csrfToken = new CsrfToken(new Dummy(), new Factory(), ['\\PitchBladeTest\\Mocks\\Security\\Generator\\Fake']);
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
        $csrfToken = new CsrfToken(new Dummy('some token'), new Factory(), ['\\PitchBladeTest\\Mocks\\Security\\Generator\\Fake']);

        $this->assertTrue($csrfToken->validate('some token'));
    }

    /**
     * @covers PitchBlade\Security\CsrfToken::__construct
     * @covers PitchBlade\Security\CsrfToken::getToken
     * @covers PitchBlade\Security\CsrfToken::validate
     */
    public function testValidateInitializedInvalid()
    {
        $csrfToken = new CsrfToken(new Dummy('some token'), new Factory(), ['\\PitchBladeTest\\Mocks\\Security\\Generator\\Fake']);
        $csrfToken->getToken();

        $this->assertFalse($csrfToken->validate('invalid'));
    }

    /**
     * @covers PitchBlade\Security\CsrfToken::__construct
     * @covers PitchBlade\Security\CsrfToken::regenerateToken
     */
    public function testRegenerateTokenSuccess()
    {
        $csrfToken = new CsrfToken(new Dummy(), new Factory(), ['\\PitchBladeTest\\Mocks\\Security\\Generator\\Fake']);
        $oldToken = $csrfToken->getToken();
        $csrfToken->regenerateToken();
        $newToken = $csrfToken->getToken();

        $this->assertInternalType('string', $newToken);

        $this->assertTrue($oldToken !== $newToken);
        $this->assertTrue($oldToken != $newToken);
    }
}
