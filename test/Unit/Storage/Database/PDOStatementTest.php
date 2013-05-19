<?php

namespace PitchBladeTest\Unit\Storage\Database;

use PitchBlade\Storage\Database\PDO,
    PitchBladeTest\Mocks\Logging\TimedLogger,
    PitchBlade\Storage\Database\PDOStatement;

class PDOStatementTest extends \PHPUnit_Framework_TestCase
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

        $dbConnection = new PDO($this->dsn, $this->username, $this->password, $this->driverOptions, new TimedLogger());
        $dbConnection->query('TRUNCATE TABLE test_table');
    }

    /**
     * @covers PitchBlade\Storage\Database\PDOStatement::__construct
     */
    public function testConstruct()
    {
        $dbConnection = new PDO($this->dsn, $this->username, $this->password, $this->driverOptions, new TimedLogger());

        $this->assertInstanceOf('\\PDOStatement', $dbConnection->query('SELECT count(*) FROM test_table'));
        $this->assertInstanceOf(
            '\\PitchBlade\\Storage\\Database\\PDOStatement',
            $dbConnection->query('SELECT count(*) FROM test_table')
        );
    }

    /**
     * @covers PitchBlade\Storage\Database\PDOStatement::__construct
     * @covers PitchBlade\Storage\Database\PDOStatement::execute
     */
    public function testExecuteWithoutParams($bound_input_params = null)
    {
        $dbConnection = new PDO($this->dsn, $this->username, $this->password, $this->driverOptions, new TimedLogger());

        $stmt = $dbConnection->prepare("INSERT INTO test_table (name) VALUES ('noparams')");
        $this->assertTrue($stmt->execute());

        $stmt = $dbConnection->query('SELECT count(*) FROM test_table');
        $this->assertSame('1', $stmt->fetch()->count);
    }

    /**
     * @covers PitchBlade\Storage\Database\PDOStatement::__construct
     * @covers PitchBlade\Storage\Database\PDOStatement::execute
     */
    public function testExecuteWithParams($bound_input_params = null)
    {
        $dbConnection = new PDO($this->dsn, $this->username, $this->password, $this->driverOptions, new TimedLogger());

        $stmt = $dbConnection->prepare("INSERT INTO test_table (name) VALUES (:name)");
        $this->assertTrue($stmt->execute(['name' => 'withparams']));

        $stmt = $dbConnection->query('SELECT count(*) FROM test_table');
        $this->assertSame('1', $stmt->fetch()->count);
    }
}
