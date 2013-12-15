<?php

namespace PitchBladeTest\Unit\Storage\Database;

use PitchBlade\Storage\Database\PDO;

class PDOTest extends \PHPUnit_Framework_TestCase
{
    protected $dsn;
    protected $username;
    protected $password;
    protected $driverOptions;

    public function setUp()
    {
        $dbInfo = \PitchBladeTest\getDatabaseInfo();

        $this->dsn = $dbInfo['dsn'];
        $this->username = $dbInfo['username'];
        $this->password = $dbInfo['password'];
        $this->driverOptions = $dbInfo['driverOptions'];

        $dbConnection = new PDO(
            $this->dsn,
            $this->username,
            $this->password,
            $this->driverOptions,
            $this->getMock('\\PitchBlade\\Logging\\Timeable')
        );
        $dbConnection->query('TRUNCATE TABLE test_table');
    }

    /**
     * @covers PitchBlade\Storage\Database\PDO::__construct
     */
    public function testConstruct()
    {
        $dbConnection = new PDO(
            $this->dsn,
            $this->username,
            $this->password,
            $this->driverOptions,
            $this->getMock('\\PitchBlade\\Logging\\Timeable')
        );

        $this->assertInstanceOf('\\PDO', $dbConnection);
        $this->assertInstanceOf('\\PitchBlade\\Storage\\Database\\PDO', $dbConnection);
    }

    /**
     * @covers PitchBlade\Storage\Database\PDO::__construct
     * @covers PitchBlade\Storage\Database\PDO::exec
     */
    public function testExec()
    {
        $dbConnection = new PDO(
            $this->dsn,
            $this->username,
            $this->password,
            $this->driverOptions,
            $this->getMock('\\PitchBlade\\Logging\\Timeable')
        );

        $this->assertSame(1, $dbConnection->exec("INSERT INTO test_table (name) VALUES ('first')"));

        $stmt = $dbConnection->query('SELECT count(*) FROM test_table');
        $this->assertSame('1', $stmt->fetch()->count);
    }

    /**
     * @covers PitchBlade\Storage\Database\PDO::__construct
     * @covers PitchBlade\Storage\Database\PDO::query
     */
    public function testQuery()
    {
        $dbConnection = new PDO(
            $this->dsn,
            $this->username,
            $this->password,
            $this->driverOptions,
            $this->getMock('\\PitchBlade\\Logging\\Timeable')
        );

        $this->assertInstanceOf(
            '\\PitchBlade\\Storage\\Database\\PDOStatement',
            $dbConnection->query("INSERT INTO test_table (name) VALUES ('second')")
        );

        $stmt = $dbConnection->query('SELECT count(*) FROM test_table');
        $this->assertSame('1', $stmt->fetch()->count);
    }

    /**
     * @covers PitchBlade\Storage\Database\PDO::__construct
     * @covers PitchBlade\Storage\Database\PDO::prepare
     */
    public function testPrepare()
    {
        $dbConnection = new PDO(
            $this->dsn,
            $this->username,
            $this->password,
            $this->driverOptions,
            $this->getMock('\\PitchBlade\\Logging\\Timeable')
        );

        $this->assertInstanceOf(
            '\\PitchBlade\\Storage\\Database\\PDOStatement',
            $dbConnection->prepare("INSERT INTO test_table (name) VALUES (:name)")
        );

        $stmt = $dbConnection->query('SELECT count(*) FROM test_table');
        $this->assertSame('0', $stmt->fetch()->count);
    }

    /**
     * @covers PitchBlade\Storage\Database\PDO::__construct
     * @covers PitchBlade\Storage\Database\PDO::commit
     */
    public function testCommit()
    {
        $dbConnection = new PDO(
            $this->dsn,
            $this->username,
            $this->password,
            $this->driverOptions,
            $this->getMock('\\PitchBlade\\Logging\\Timeable')
        );

        $dbConnection->beginTransaction();

        $this->assertTrue($dbConnection->commit());
    }
}
