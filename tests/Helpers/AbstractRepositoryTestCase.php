<?php declare(strict_types=1);

namespace RepositoryTester\Test\Helpers;

use PHPUnit\Framework\TestCase;
use RepositoryTester\DataFactory\DataFactoryAwareInterface;
use RepositoryTester\DataFactory\DataFactoryAwareTrait;
use RepositoryTester\Repository\RepositoryAwareInterface;
use RepositoryTester\RepositoryAssertTrait;

class AbstractRepositoryTestCase extends TestCase implements RepositoryAwareInterface, DataFactoryAwareInterface
{
    use RepositoryAssertTrait;
    use DataFactoryAwareTrait;

    protected const DB_TABLE = 'test';

    protected function tearDown()
    {
        $this->clearTables();

        parent::tearDown();
    }

    /**
     * @param string $table
     * @param int    $times
     * @param array  $arguments
     *
     * @return array
     */
    protected function add(string $table, int $times = 1, array $arguments = []): array
    {
        return $this->insert(
            $this
                ->getDataFactory()
                ->create($table, $times, $arguments)
        );
    }
}
