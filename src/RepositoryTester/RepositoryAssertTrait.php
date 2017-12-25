<?php declare(strict_types=1);

namespace RepositoryTester;

use PHPUnit\Framework\Assert;
use RepositoryTester\Repository\RepositoryAwareTrait;

trait RepositoryAssertTrait
{
    use RepositoryAwareTrait;

    /**
     * @param string $repositoryName
     * @param array  $expected
     */
    protected function assertRepositoryHasRow(string $repositoryName, array $expected): void
    {
        Assert::assertGreaterThan(
            0,
            $this->getRowCount($repositoryName, ['where' => $expected]),
            'Could not find the data in a database'
        );
    }

    /**
     * @param string $repositoryName
     * @param array  $expected
     */
    protected function assertRepositoryHasRows(string $repositoryName, array $expected): void
    {
        foreach ($expected as $row) {
            $this->assertRepositoryHasRow($repositoryName, $row);
        }
    }

    /**
     * @param string $repositoryName
     * @param int    $expected
     */
    protected function assertRowCount(string $repositoryName, int $expected): void
    {
        Assert::assertEquals($expected, $this->getRowCount($repositoryName));
    }
}
