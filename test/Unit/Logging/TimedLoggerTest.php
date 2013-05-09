<?php

namespace PitchBladeTest\Logging;

use PitchBlade\Logging\TimedLogger,
    PitchBladeTest\Mocks\Logging\Logger;

class TimedLoggerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PitchBlade\Logging\TimedLogger::__construct
     * @covers PitchBlade\Logging\TimedLogger::start
     */
    public function testStartUniqueId()
    {
        $logger = new TimedLogger(new Logger());

        $previousIds = [];
        for ($i = 0; $i < 10; $i++) {
            $uniqid = $logger->start();
            $this->assertInternalType('string', $uniqid);
            $this->assertSame(23, strlen($uniqid));
            $this->assertFalse(in_array($uniqid, $previousIds));
        }
    }

    /**
     * @covers PitchBlade\Logging\TimedLogger::__construct
     * @covers PitchBlade\Logging\TimedLogger::start
     * @covers PitchBlade\Logging\TimedLogger::end
     */
    public function testEndSingleValid()
    {
        $logger = new TimedLogger(new Logger());
        $uniqid = $logger->start();

        $this->assertInternalType('float', $logger->end($uniqid, 'theType', 'theAction'));
    }

    /**
     * @covers PitchBlade\Logging\TimedLogger::__construct
     * @covers PitchBlade\Logging\TimedLogger::start
     * @covers PitchBlade\Logging\TimedLogger::end
     */
    public function testEndMultipleFirstValid()
    {
        $logger = new TimedLogger(new Logger());
        $uniqid = $logger->start();

        for ($i = 0; $i < 10; $i++) {
            $logger->start();
        }

        $this->assertInternalType('float', $logger->end($uniqid, 'theType', 'theAction'));
    }

    /**
     * @covers PitchBlade\Logging\TimedLogger::__construct
     * @covers PitchBlade\Logging\TimedLogger::start
     * @covers PitchBlade\Logging\TimedLogger::end
     */
    public function testEndMultipleLastValid()
    {
        $logger = new TimedLogger(new Logger());
        $uniqid = $logger->start();

        for ($i = 0; $i < 10; $i++) {
            $uniqid = $logger->start();
        }

        $this->assertInternalType('float', $logger->end($uniqid, 'theType', 'theAction'));
    }

    /**
     * @covers PitchBlade\Logging\TimedLogger::__construct
     * @covers PitchBlade\Logging\TimedLogger::start
     * @covers PitchBlade\Logging\TimedLogger::end
     */
    public function testEndThrowsException()
    {
        $logger = new TimedLogger(new Logger());
        $logger->start();

        $this->setExpectedException('\\PitchBlade\Logging\\UnknownTimedLogItemException');

        $logger->end('unknown', 'theType', 'theAction');
    }
}
