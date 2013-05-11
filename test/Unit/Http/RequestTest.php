<?php

namespace PitchBladeTest\Unit\Http;

use PitchBlade\Http\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    protected $serverVariables;
    protected $getVariables;
    protected $postVariables;
    protected $mapping;
    protected $mappingFailed;

    public function setUp()
    {
        $this->serverVariables = \PitchBladeTest\getTestDataFromFile(PITCHBLADE_TEST_DATA_DIR . '/Http/server-variables.php');
        $this->getVariables    = \PitchBladeTest\getTestDataFromFile(PITCHBLADE_TEST_DATA_DIR . '/Http/get-variables.php');
        $this->postVariables   = \PitchBladeTest\getTestDataFromFile(PITCHBLADE_TEST_DATA_DIR . '/Http/post-variables.php');
        $this->mapping         = \PitchBladeTest\getTestDataFromFile(PITCHBLADE_TEST_DATA_DIR . '/Http/request-mapper.php');
        $this->mappingFailed   = \PitchBladeTest\getTestDataFromFile(PITCHBLADE_TEST_DATA_DIR . '/Http/request-mapper-fail.php');
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getPath
     */
    public function testGetPath()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
        $this->assertSame('/some/deep/path', $request->getPath());
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::setPathVariables
     */
    public function testSetPathVariablesSuccess()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
        $this->assertNull($request->setPathVariables($this->mapping));
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::setPathVariables
     */
    public function testSetPathVariablesWithUndefinedIndexSuccess()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
        $this->assertNull($request->setPathVariables($this->mappingFailed));
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getGetVariables
     */
    public function testGetGetVariables()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
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
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
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
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
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
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
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
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
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
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
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
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
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
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
        $this->assertSame('nonDefault', $request->getPostVariable('postvar99', 'nonDefault'));
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getPathVariables
     */
    public function testGetPathVariablesWithoutMapping()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
        $this->assertSame([], $request->getPathVariables());
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getPathVariables
     */
    public function testGetPathVariablesWithMapping()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
        $request->setPathVariables($this->mapping);
        $this->assertSame(['first_var' => 'some', 'second_var' => 'deep'], $request->getPathVariables());
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getPathVariable
     */
    public function testGetPathVariableWithKnownVariable()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
        $request->setPathVariables($this->mapping);
        $this->assertSame('some', $request->getPathVariable('first_var'));
    }

    /**
     * @covers PitchBlade\Http\Request::__construct
     * @covers PitchBlade\Http\Request::setPath
     * @covers PitchBlade\Http\Request::getBarePath
     * @covers PitchBlade\Http\Request::getPathVariable
     */
    public function testGetPathVariableWithUnknownVariableDefault()
    {
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
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
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
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
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
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
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
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
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
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
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
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
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
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
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
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
        $request = new Request($this->serverVariables, $this->getVariables, $this->postVariables);
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

        $request = new Request($serverVariables, $this->getVariables, $this->postVariables);
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

        $request = new Request($serverVariables, $this->getVariables, $this->postVariables);
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

        $request = new Request($serverVariables, $this->getVariables, $this->postVariables);
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

        $request = new Request($serverVariables, $this->getVariables, $this->postVariables);
        $this->assertFalse($request->isSsl());
    }
}
