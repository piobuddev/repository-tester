<?php declare(strict_types=1);

namespace RepositoryTester\Repository;

use RepositoryTester\Repository\Connection\ConnectionInterface;

interface RepositoryAwareInterface
{
    /**
     * @param \RepositoryTester\Repository\Connection\ConnectionInterface $connection
     */
    public function setConnection(ConnectionInterface $connection): void;
}
