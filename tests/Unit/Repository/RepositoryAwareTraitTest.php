<?php declare(strict_types=1);

namespace RepositoryTester\Test\Repository;

use PHPUnit\Framework\TestCase;
use RepositoryTester\Repository\Connection\ConnectionInterface;
use RepositoryTester\Repository\RepositoryAwareTrait;

class RepositoryAwareTraitTest extends TestCase
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\RepositoryTester\Repository\RepositoryAwareTrait
     */
    private $cut;

    /**
     * @var \RepositoryTester\Repository\Connection\ConnectionInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private $connection;

    protected function setUp()
    {
        parent::setUp();

        /** @var \RepositoryTester\Repository\Connection\ConnectionInterface $connection */
        $connection = $this->createMock(ConnectionInterface::class);
        /** @var \RepositoryTester\Repository\RepositoryAwareTrait $cut */
        $cut = $this->getMockForTrait(RepositoryAwareTrait::class);
        $cut->setConnection($connection);

        $this->cut        = $cut;
        $this->connection = $connection;
    }

    public function testClearTablesCallsConnectionClear()
    {
        $tables = ['table'];
        $this
            ->connection
            ->expects($this->once())->method('clear')->with($tables);

        $this->cut->clearTables($tables);
    }

    public function testInsertCallsConnectionInsert()
    {
        $data = ['data'];
        $this->connection
            ->expects($this->once())
            ->method('insert')->with($data)->willReturn($data);

        $this->assertEquals($data, $this->cut->insert($data));
    }

    public function testGetRowCountCallsConnectionCount()
    {
        $this->connection
            ->expects($this->once())
            ->method('count')->with('table', ['args'])->willReturn(1);

        $this->assertEquals(1, $this->cut->getRowCount('table', ['args']));
    }

    public function testFetchAllCallsConnectionFetchAll()
    {
        $this->connection
            ->expects($this->once())
            ->method('fetchAll')->with('table', ['args'])->willReturn([]);

        $this->assertEquals([], $this->cut->fetchAll('table', ['args']));
    }
}
