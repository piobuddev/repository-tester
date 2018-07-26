<?php declare(strict_types=1);

namespace RepositoryTester\Repository;

use PHPUnit\Framework\Assert;
use RepositoryTester\Repository\Connection\ConnectionInterface;

trait RepositoryAwareTrait
{
    /**
     * @var \RepositoryTester\Repository\Connection\ConnectionInterface
     */
    private $connection;

    /**
     * @param \RepositoryTester\Repository\Connection\ConnectionInterface $connection
     */
    public function setConnection(ConnectionInterface $connection): void
    {
        $this->connection = $connection;
    }

    /**
     * @param string     $tableName
     * @param array|null $arguments
     *
     * @return array
     */
    public function fetchAll(string $tableName, array $arguments = null): array
    {
        return $this->getConnection()->fetchAll($tableName, $arguments);
    }

    /**
     * @param string $tableName
     * @param array  $arguments
     *
     * @return int
     */
    public function getRowCount(string $tableName, array $arguments = []): int
    {
        return $this->getConnection()->count($tableName, $arguments);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function insert(array $data): array
    {
        return $this->getConnection()->insert($data);
    }

    /**
     * @param array|null $tables
     */
    public function clearTables(array $tables = null): void
    {
        $this->getConnection()->clear($tables);
    }

    /**
     * @return void
     */
    public function disableForeignKeys(): void
    {
        $this->getConnection()->disableForeignKeys();
    }

    /**
     * @return void
     */
    public function enableForeignKeys(): void
    {
        $this->getConnection()->enableForeignKeys();
    }

    /**
     * @return \RepositoryTester\Repository\Connection\ConnectionInterface
     */
    private function getConnection(): ConnectionInterface
    {
        if (null === $this->connection) {
            Assert::assertNotNull($this->connection, 'Undefined database connection');
        }

        return $this->connection;
    }
}
