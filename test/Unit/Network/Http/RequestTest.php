<?php

namespace PitchBladeTest\Unit\Network\Http;

use PitchBlade\Network\Http\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     */
    public function testConstructCorrectInterface()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertInstanceOf('\\PitchBlade\\Network\\Http\\RequestData', $request);
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     */
    public function testConstructCorrectInstance()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertInstanceOf('\\PitchBlade\\Network\\Http\\Request', $request);
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::pathIterator
     */
    public function testPathIterator()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertInstanceOf('\\PitchBlade\\Storage\\ImmutableKeyValue', $request->pathIterator());
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::getIterator
     */
    public function testGetIterator()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertInstanceOf('\\PitchBlade\\Storage\\ImmutableKeyValue', $request->getIterator());
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::postIterator
     */
    public function testPostIterator()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertInstanceOf('\\PitchBlade\\Storage\\ImmutableKeyValue', $request->postIterator());
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::serverIterator
     */
    public function testServerIterator()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertInstanceOf('\\PitchBlade\\Storage\\ImmutableKeyValue', $request->serverIterator());
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::filesIterator
     */
    public function testFilesIterator()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertInstanceOf('\\PitchBlade\\Storage\\ImmutableKeyValue', $request->filesIterator());
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::cookiesIterator
     */
    public function testCookiesIterator()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertInstanceOf('\\PitchBlade\\Storage\\ImmutableKeyValue', $request->cookiesIterator());
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::path
     */
    public function testPathExists()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $pathVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $pathVariables->expects($this->any())->method('get')->will($this->returnValue('bar'));

        $request = new Request(
            $pathVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertSame('bar', $request->path('foo'));
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::path
     */
    public function testPathNotExistsDefaultValue()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertNull($request->path('foo'));
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::path
     */
    public function testPathNotExistsCustomDefaultValue()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $pathVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $pathVariables->expects($this->any())->method('get')->will($this->returnArgument(1));

        $request = new Request(
            $pathVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertSame('bar', $request->path('foo', 'bar'));
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::get
     */
    public function testGetExists()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $getVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $getVariables->expects($this->any())->method('get')->will($this->returnValue('bar'));

        $request = new Request(
            $requestVariables,
            $getVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertSame('bar', $request->get('foo'));
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::get
     */
    public function testGetNotExistsDefaultValue()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertNull($request->get('foo'));
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::get
     */
    public function testGetNotExistsCustomDefaultValue()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $getVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $getVariables->expects($this->any())->method('get')->will($this->returnArgument(1));

        $request = new Request(
            $requestVariables,
            $getVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertSame('bar', $request->get('foo', 'bar'));
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::post
     */
    public function testPostExists()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $postVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $postVariables->expects($this->any())->method('get')->will($this->returnValue('bar'));

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $postVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertSame('bar', $request->post('foo'));
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::post
     */
    public function testPostNotExistsDefaultValue()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertNull($request->post('foo'));
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::post
     */
    public function testPostNotExistsCustomDefaultValue()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $postVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $postVariables->expects($this->any())->method('get')->will($this->returnArgument(1));

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $postVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertSame('bar', $request->post('foo', 'bar'));
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::server
     */
    public function testServerExists()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $serverVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue('bar'));

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $serverVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertSame('bar', $request->server('foo'));
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::server
     */
    public function testServerNotExistsDefaultValue()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertNull($request->server('foo'));
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::server
     */
    public function testServerNotExistsCustomDefaultValue()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $serverVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnArgument(1));

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $serverVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertSame('bar', $request->server('foo', 'bar'));
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::files
     */
    public function testFilesExists()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $filesVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $filesVariables->expects($this->any())->method('get')->will($this->returnValue('bar'));

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $filesVariables,
            $requestVariables
        );

        $this->assertSame('bar', $request->files('foo'));
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::files
     */
    public function testFilesNotExistsDefaultValue()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertNull($request->files('foo'));
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::files
     */
    public function testFilesNotExistsCustomDefaultValue()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $filesVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $filesVariables->expects($this->any())->method('get')->will($this->returnArgument(1));

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $filesVariables,
            $requestVariables
        );

        $this->assertSame('bar', $request->files('foo', 'bar'));
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::cookie
     */
    public function testCookieExists()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $cookieVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $cookieVariables->expects($this->any())->method('get')->will($this->returnValue('bar'));

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $cookieVariables
        );

        $this->assertSame('bar', $request->cookie('foo'));
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::cookie
     */
    public function testCookieNotExistsDefaultValue()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertNull($request->cookie('foo'));
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::cookie
     */
    public function testCookieNotExistsCustomDefaultValue()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $cookieVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $cookieVariables->expects($this->any())->method('get')->will($this->returnArgument(1));

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $cookieVariables
        );

        $this->assertSame('bar', $request->cookie('foo', 'bar'));
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::setParameters
     */
    public function testSetParameters()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertNull($request->setParameters([1, 2, 3, 4, 5]));
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::setParameters
     * @covers PitchBlade\Network\Http\Request::param
     */
    public function testParamExists()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $request->setParameters(['foo', 'bar', 'baz']);

        $this->assertSame('foo', $request->param(0));
        $this->assertSame('bar', $request->param(1));
        $this->assertSame('baz', $request->param(2));
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::param
     */
    public function testParamNotExistsDefaultValue()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertNull($request->param(0));
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::param
     */
    public function testParamNotExistsCustomDefaultValue()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertSame('bar', $request->param('0', 'bar'));
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::getPath
     */
    public function testGetPath()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $serverVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue('/foo/bar'));

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $serverVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertSame('/foo/bar', $request->getPath());
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::getPath
     */
    public function testGetPathWithQueryString()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $serverVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue('/foo/bar?foo=bar'));

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $serverVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertSame('/foo/bar', $request->getPath());
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::getMethod
     */
    public function testGetMethod()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $serverVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue('POST'));

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $serverVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertSame('POST', $request->getMethod());
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::isXhr
     */
    public function testIsXhrTrue()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $serverVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue('XMLHttpRequest'));

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $serverVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertTrue($request->isXhr());
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::isXhr
     */
    public function testIsXhrFalse()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $serverVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue('XMLHttpRequestFalse'));

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $serverVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertFalse($request->isXhr());
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::isSecure
     */
    public function testIsSecureTrueNotEmpty()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $serverVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue('Non empty value'));

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $serverVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertTrue($request->isSecure());
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::isSecure
     */
    public function testIsSecureTrueOn()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $serverVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue('on'));

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $serverVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertTrue($request->isSecure());
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::isSecure
     */
    public function testIsSecureFalseEmptyString()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $serverVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue(''));

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $serverVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertFalse($request->isSecure());
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::isSecure
     */
    public function testIsSecureFalseNull()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $serverVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue(null));

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $serverVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertFalse($request->isSecure());
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::isSecure
     */
    public function testIsSecureFalseOff()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $serverVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $serverVariables->expects($this->any())->method('get')->will($this->returnValue('off'));

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $serverVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertFalse($request->isSecure());
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::isSecure
     * @covers PitchBlade\Network\Http\Request::getBaseUrl
     */
    public function testGetBaseUrlSecure()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $serverVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $serverVariables->expects($this->at(0))->method('get')->will($this->returnValue('on'));
        $serverVariables->expects($this->at(1))->method('get')->will($this->returnValue('pieterhordijk.com'));

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $serverVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertSame('https://pieterhordijk.com', $request->getBaseUrl());
    }

    /**
     * @covers PitchBlade\Network\Http\Request::__construct
     * @covers PitchBlade\Network\Http\Request::isSecure
     * @covers PitchBlade\Network\Http\Request::getBaseUrl
     */
    public function testGetBaseUrl()
    {
        $requestVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');

        $serverVariables = $this->getMock('\\PitchBlade\\Storage\\ImmutableKeyValue');
        $serverVariables->expects($this->at(0))->method('get')->will($this->returnValue('off'));
        $serverVariables->expects($this->at(1))->method('get')->will($this->returnValue('pieterhordijk.com'));

        $request = new Request(
            $requestVariables,
            $requestVariables,
            $requestVariables,
            $serverVariables,
            $requestVariables,
            $requestVariables
        );

        $this->assertSame('http://pieterhordijk.com', $request->getBaseUrl());
    }
}
