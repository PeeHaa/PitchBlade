<?php

namespace PitchBladeTest\Unit\Http;

use PitchBlade\Http\Request,
    PitchBladeTest\Mocks\Router\RouteWithoutPathVariables,
    PitchBladeTest\Mocks\Router\RouteWithPathVariables;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    protected $serverVariables;
    protected $getVariables;
    protected $postVariables;
    protected $cookieVariables;

    public function setUp()
    {
        $this->serverVariables = \PitchBladeTest\getTestDataFromFile(PITCHBLADE_TEST_DATA_DIR . '/Http/server-variables.php');
        $this->getVariables    = \PitchBladeTest\getTestDataFromFile(PITCHBLADE_TEST_DATA_DIR . '/Http/get-variables.php');
        $this->postVariables   = \PitchBladeTest\getTestDataFromFile(PITCHBLADE_TEST_DATA_DIR . '/Http/post-variables.php');
        $this->cookieVariables = ['key' => 'value'];
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     */
    public function testConstructCorrectInterface()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertInstanceOf('\\PitchBlade\\Http\\Request', $request);
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getPath
     */
    public function testGetPath()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('/some/deep/path', $request->getPath());
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::setPathVariables
     */
    public function testSetPathVariablesSuccessWithoutPathVariables()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertNull($request->setPathVariables(new RouteWithoutPathVariables()));
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getGetVariables
     */
    public function testGetGetVariables()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame($this->getVariables, $request->getGetVariables());
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getGetVariable
     */
    public function testGetGetVariableWithKnownVariable()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('value1', $request->getGetVariable('var1'));
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getGetVariable
     */
    public function testGetGetVariableWithUnknownVariableDefault()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertNull($request->getGetVariable('var99'));
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getGetVariable
     */
    public function testGetGetVariableWithUnknownVariableNotDefault()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('nonDefault', $request->getGetVariable('var99', 'nonDefault'));
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getPostVariables
     */
    public function testGetPostVariables()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame($this->postVariables, $request->getPostVariables());
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getPostVariable
     */
    public function testGetPostVariableWithKnownVariable()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('postvalue1', $request->getPostVariable('postvar1'));
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getPostVariable
     */
    public function testGetPostVariableWithUnknownVariableDefault()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertNull($request->getPostVariable('postvar99'));
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getPostVariable
     */
    public function testGetPostVariableWithUnknownVariableNotDefault()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('nonDefault', $request->getPostVariable('postvar99', 'nonDefault'));
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getCookieVariables
     */
    public function testGetCookieVariables()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame($this->cookieVariables, $request->getCookieVariables());
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getCookieVariable
     */
    public function testGetCookieVariableWithKnownVariable()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('value', $request->getCookieVariable('key'));
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getCookieVariable
     */
    public function testGetCookieVariableWithUnknownVariableDefault()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertNull($request->getCookieVariable('cookievar99'));
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getCookieVariable
     */
    public function testGetCookieVariableWithUnknownVariableNotDefault()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('nonDefault', $request->getCookieVariable('postvar99', 'nonDefault'));
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getPathVariables
     */
    public function testGetPathVariablesWithoutPathVariables()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame([], $request->getPathVariables());
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::setPathVariables
     * @covers PitchBlade\Http\Request::getPathVariables
     */
    public function testGetPathVariablesWithPathVariables()
    {
        $ori = $this->serverVariables['REQUEST_URI'];
        $this->serverVariables['REQUEST_URI'] = '/test1/test2/test3';

        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $request->setPathVariables(new RouteWithPathVariables());
        $this->assertSame(['var1' => 'test1', 'var2' => 'test2'], $request->getPathVariables());

        $this->serverVariables['REQUEST_URI'] = $ori;
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::setPathVariables
     * @covers PitchBlade\Http\Request::getPathVariable
     */
    public function testGetPathVariableWithKnownVariable()
    {
        $ori = $this->serverVariables['REQUEST_URI'];
        $this->serverVariables['REQUEST_URI'] = '/test1/test2/test3';

        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $request->setPathVariables(new RouteWithPathVariables());
        $this->assertSame('test1', $request->getPathVariable('var1'));

        $this->serverVariables['REQUEST_URI'] = $ori;
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getPathVariable
     */
    public function testGetPathVariableWithUnknownVariableDefault()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertNull($request->getPostVariable('unknown_var'));
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getPathVariable
     */
    public function testGetPathVariableWithUnknownVariableNotDefault()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('nonDefault', $request->getPathVariable('unknown_var', 'nonDefault'));
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getServerVariables
     */
    public function testGetServerVariables()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame($this->serverVariables, $request->getServerVariables());
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getServerVariable
     */
    public function testGetServerVariableWithKnownVariable()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('example.com', $request->getServerVariable('SERVER_NAME'));
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getServerVariable
     */
    public function testGetServerVariableWithUnknownVariableDefault()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertNull($request->getServerVariable('unknownservervariable'));
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getServerVariable
     */
    public function testGetServerVariableWithUnknownVariableNotDefault()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('nonDefault', $request->getServerVariable('unknownservervariable', 'nonDefault'));
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getMethod
     */
    public function testGetMethod()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('POST', $request->getMethod());
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getHost
     */
    public function testGetHost()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertSame('www.example.com', $request->getHost());
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::isSsl
     */
    public function testIsSslWithOn()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertTrue($request->isSsl());
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::isSsl
     */
    public function testIsSslWithOff()
    {
        $serverVariables = $this->serverVariables;
        $serverVariables['HTTPS'] = 'off';

        $request = new Request($serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertFalse($request->isSsl());
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::isSsl
     */
    public function testIsSslWithoutValue()
    {
        $serverVariables = $this->serverVariables;
        $serverVariables['HTTPS'] = '';

        $request = new Request($serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertFalse($request->isSsl());
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::isSsl
     */
    public function testIsSslWithSomeString()
    {
        $serverVariables = $this->serverVariables;
        $serverVariables['HTTPS'] = 'somerandomstring';

        $request = new Request($serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertTrue($request->isSsl());
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::isSsl
     */
    public function testIsSslWithoutHttpsKey()
    {
        $serverVariables = $this->serverVariables;
        unset($serverVariables['HTTPS']);

        $request = new Request($serverVariables, $this->getVariables, $this->postVariables, $this->cookieVariables);
        $this->assertFalse($request->isSsl());
    }
}
