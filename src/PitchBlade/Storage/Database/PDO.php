<?php
/**
 * PDO class
 *
 * We are using this class only to make it easy to log queries
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Storage
 * @subpackage Database
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Storage\Database;

use PitchBlade\Logging\Timeable;

/**
 * PDO class
 *
 * @category   PitchBlade
 * @package    Storage
 * @subpackage Database
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class PDO extends \PDO
{
    /**
     * @var PitchBlade\Logging\Timeable The logger
     */
    private $logger;

    /**
     * Creates a PDO instance representing a connection to a database
     *
     * @param string                       $dsn            The DSN (connection) string
     * @param string                       $username       The database username
     * @param string                       $password       The database password
     * @param array                        $driver_options The driver options
     * @param \PitchBlade\Logging\Timeable $logger         The timed logger
     *
     * @throws \PDOException When the connection could not be established
     */
    public function __construct($dsn, $username, $password, array $driver_options, Timeable $logger)
    {
        $this->logger = $logger;

        parent::__construct($dsn, $username, $password, $driver_options);
    }

    /**
     * Executes an SQL statement and return the number of affected rows
     *
     * @param string $statement The SQL statement to execute
     *
     * @return false|int False when an error occured and the number of affected rows otherwise
     * @throws \PDOException When the query failed
     */
    public function exec($statement)
    {
        $logId = $this->logger->start();

        $result = parent::exec($statement);

        $this->logger->end($logId, 'PDO::exec', $statement);

        return $result;
    }

    /**
     * Executes an SQL statement, returning a result set as a PDOStatement object
     *
     * Note that this method only implements the `PDO::query` call with a single parameter.
     * http://www.php.net/manual/en/pdo.query.php
     *
     * @param string $statement The SQL statement to execute
     *
     * @return false|\PDOStatement False on failure or instance of \PDOStatement on success
     * @throws \PDOException When the query failed
     */
    public function query($statement)
    {
        $logId = $this->logger->start();

        $result = parent::query($statement);

        $this->logger->end($logId, 'PDO::query', $statement);

        return $result;
    }

    /**
     * Prepares a statement for execution and returns a statement object
     *
     * @param string     $statement      The SQL statement to prepare
     * @param null|array $driver_options The driver options
     *
     * @return \PDOStatement The PDO statement
     * @throws \PDOException When the prepare failed
     */
    public function prepare($statement, $driver_options = [])
    {
        $logId = $this->logger->start();

        $result = parent::prepare($statement, $driver_options);

        $this->logger->end($logId, 'PDO::prepare', $statement);

        return $result;
    }

    /**
     * Commits a transaction
     *
     * @return boolean True on success
     */
    public function commit()
    {
        $logId = $this->logger->start();

        $result = parent::commit();

        $this->logger->end($logId, 'PDO::commit', null);

        return $result;
    }
}
