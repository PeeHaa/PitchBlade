<?php
/**
 * PDO statement class
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
 * PDO statement class
 *
 * @category   PitchBlade
 * @package    Storage
 * @subpackage Database
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class PDOStatement extends \PDOStatement
{
    /**
     * @var PitchBlade\Logging\Timeable The logger
     */
    private $logger;

    /**
     * Creates a PDOStatement instance
     *
     * @param \PitchBlade\Logging\Timeable $logger The timed logger
     */
    protected function __construct(Timeable $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Executes a prepared statement
     *
     * @param array $bound_input_params The list of parameters
     *
     * @return boolean       True on success
     * @throws \PDOException On failure
     */
    public function execute($bound_input_params = null)
    {
        $logId = $this->logger->start();

        $result = parent::execute($bound_input_params);

        $this->logger->end($logId, 'PDOStatement::execute', json_encode($bound_input_params));

        return $result;
    }
}
