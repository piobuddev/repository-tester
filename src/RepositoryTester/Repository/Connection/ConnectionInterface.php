<?php declare(strict_types=1);

namespace RepositoryTester\Repository\Connection;

interface ConnectionInterface
{
    /**
     * Closes a connection
     */
    public function close(): void;

    /**
     * @param string     $entity - an entity name
     * @param array|null $arguments
     *
     * @return array
     */
    public function fetchAll(string $entity, array $arguments = null): array;

    /**
     * @param array $data
     *
     * @return array
     */
    public function insert(array $data): array;

    /**
     * @param string $entity
     * @param array  $args
     *
     * @return int
     */
    public function count(string $entity, array $args = []): int;

    /**
     * @param array|null $entities
     *
     * @return \RepositoryTester\Repository\Connection\ConnectionInterface
     */
    public function clear(array $entities = null): ConnectionInterface;

    /**
     * @return void
     */
    public function disableForeignKeys(): void;

    /**
     * @return void
     */
    public function enableForeignKeys(): void;
}
