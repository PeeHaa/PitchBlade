<?php

namespace PitchBladeTest\Unit\Logging;

use PitchBlade\Logging\ArrayLogger;

class ArrayLoggerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Logging\ArrayLogger::__construct
     */
    public function testConstructCorrectInterface()
    {
        $logger = new ArrayLogger();

        $this->assertInstanceOf('\\PitchBlade\\Logging\\Logger', $logger);
    }

    /**
     * @covers PitchBlade\Logging\ArrayLogger::__construct
     * @covers PitchBlade\Logging\ArrayLogger::log
     */
    public function testLogWithDefaultFormatWithoutExecutionTime()
    {
        $logger = new ArrayLogger();

        $this->assertNull($logger->log('someType', 'someAction'));
    }

    /**
     * @covers PitchBlade\Logging\ArrayLogger::__construct
     * @covers PitchBlade\Logging\ArrayLogger::log
     */
    public function testLogWithCustomFormatWithoutExecutionTime()
    {
        $logger = new ArrayLogger('u');

        $this->assertNull($logger->log('someType', 'someAction'));
    }

    /**
     * @covers PitchBlade\Logging\ArrayLogger::__construct
     * @covers PitchBlade\Logging\ArrayLogger::log
     */
    public function testLogWithDefaultFormatWithExecutionTime()
    {
        $logger = new ArrayLogger();

        $this->assertNull($logger->log('someType', 'someAction', 10));
    }

    /**
     * @covers PitchBlade\Logging\ArrayLogger::__construct
     * @covers PitchBlade\Logging\ArrayLogger::log
     */
    public function testLogWithCustomFormatWithExecutionTime()
    {
        $logger = new ArrayLogger('u');

        $this->assertNull($logger->log('someType', 'someAction', 10));
    }

    /**
     * @covers PitchBlade\Logging\ArrayLogger::__construct
     * @covers PitchBlade\Logging\ArrayLogger::log
     * @covers PitchBlade\Logging\ArrayLogger::report
     */
    public function testReportWithDefaultFormatWithoutExecutionTime()
    {
        $logger = new ArrayLogger();

        $logger->log('someType', 'someAction');

        $logItems = $logger->report();

        $this->assertSame(1, count($logItems));
        $this->assertSame('someType', $logItems[0]['type']);
        $this->assertSame('someAction', $logItems[0]['action']);
        $this->assertNull($logItems[0]['executionTime']);
        $this->assertSame(\DateTime::createFromFormat('d-m-Y H:i:s', $logItems[0]['time'])->format('d-m-Y H:i:s'), $logItems[0]['time']);
    }

    /**
     * @covers PitchBlade\Logging\ArrayLogger::__construct
     * @covers PitchBlade\Logging\ArrayLogger::log
     * @covers PitchBlade\Logging\ArrayLogger::report
     */
    public function testReportWithCustomFormatWithoutExecutionTime()
    {
        $logger = new ArrayLogger('d-m-Y');

        $logger->log('someType', 'someAction');

        $logItems = $logger->report();

        $this->assertSame(1, count($logItems));
        $this->assertSame('someType', $logItems[0]['type']);
        $this->assertSame('someAction', $logItems[0]['action']);
        $this->assertNull($logItems[0]['executionTime']);
        $this->assertSame(\DateTime::createFromFormat('d-m-Y', $logItems[0]['time'])->format('d-m-Y'), $logItems[0]['time']);
    }

    /**
     * @covers PitchBlade\Logging\ArrayLogger::__construct
     * @covers PitchBlade\Logging\ArrayLogger::log
     * @covers PitchBlade\Logging\ArrayLogger::report
     */
    public function testReportWithDefaultFormatWithExecutionTime()
    {
        $logger = new ArrayLogger();

        $logger->log('someType', 'someAction', 10);

        $logItems = $logger->report();

        $this->assertSame(1, count($logItems));
        $this->assertSame('someType', $logItems[0]['type']);
        $this->assertSame('someAction', $logItems[0]['action']);
        $this->assertSame(10, $logItems[0]['executionTime']);
        $this->assertSame(\DateTime::createFromFormat('d-m-Y H:i:s', $logItems[0]['time'])->format('d-m-Y H:i:s'), $logItems[0]['time']);
    }

    /**
     * @covers PitchBlade\Logging\ArrayLogger::__construct
     * @covers PitchBlade\Logging\ArrayLogger::log
     * @covers PitchBlade\Logging\ArrayLogger::report
     */
    public function testReportCustomFormatWithExecutionTime()
    {
        $logger = new ArrayLogger('d-m-Y');

        $logger->log('someType', 'someAction', 10);

        $logItems = $logger->report();

        $this->assertSame(1, count($logItems));
        $this->assertSame('someType', $logItems[0]['type']);
        $this->assertSame('someAction', $logItems[0]['action']);
        $this->assertSame(10, $logItems[0]['executionTime']);
        $this->assertSame(\DateTime::createFromFormat('d-m-Y', $logItems[0]['time'])->format('d-m-Y'), $logItems[0]['time']);
    }

    /**
     * @covers PitchBlade\Logging\ArrayLogger::__construct
     * @covers PitchBlade\Logging\ArrayLogger::log
     * @covers PitchBlade\Logging\ArrayLogger::report
     */
    public function testReportWithMultipleItems()
    {
        $logger = new ArrayLogger();

        $logger->log('firstType', 'firstAction');
        $logger->log('secondType', 'secondAction', 10);
        $logger->log('thirdType', 'thirdAction', 99);

        $logItems = $logger->report();

        $this->assertSame(3, count($logItems));
        $this->assertSame('firstType', $logItems[0]['type']);
        $this->assertSame('firstAction', $logItems[0]['action']);
        $this->assertNull($logItems[0]['executionTime']);
        $this->assertSame(\DateTime::createFromFormat('d-m-Y H:i:s', $logItems[0]['time'])->format('d-m-Y H:i:s'), $logItems[0]['time']);

        $this->assertSame('secondType', $logItems[1]['type']);
        $this->assertSame('secondAction', $logItems[1]['action']);
        $this->assertSame(10, $logItems[1]['executionTime']);
        $this->assertSame(\DateTime::createFromFormat('d-m-Y H:i:s', $logItems[0]['time'])->format('d-m-Y H:i:s'), $logItems[1]['time']);

        $this->assertSame('thirdType', $logItems[2]['type']);
        $this->assertSame('thirdAction', $logItems[2]['action']);
        $this->assertSame(99, $logItems[2]['executionTime']);
        $this->assertSame(\DateTime::createFromFormat('d-m-Y H:i:s', $logItems[0]['time'])->format('d-m-Y H:i:s'), $logItems[2]['time']);
    }
}
