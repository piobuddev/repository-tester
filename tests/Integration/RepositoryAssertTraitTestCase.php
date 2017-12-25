<?php declare(strict_types=1);

namespace RepositoryTester\Test;

use RepositoryTester\RepositoryAssertTrait;
use RepositoryTester\Test\Helpers\AbstractRepositoryTestCase;

class RepositoryAssertTraitTestCase extends AbstractRepositoryTestCase
{
    use RepositoryAssertTrait;

    public function testAssertRowCount()
    {
        $this->add(self::DB_TABLE, 5);
        $this->assertRowCount(self::DB_TABLE, 5);
    }

    public function testAssertRepositoryHasRow()
    {
        $jessicaHyde = ['first_name' => 'Jessica', 'last_name' => 'Hyde'];

        $this->add(self::DB_TABLE, 5);
        $this->add(self::DB_TABLE, 1, $jessicaHyde);

        $this->assertRowCount(self::DB_TABLE, 6);
        $this->assertRepositoryHasRow(self::DB_TABLE, $jessicaHyde);
    }

    public function testAssertRepositoryHasRows()
    {
        $jessicaHyde = ['first_name' => 'Jessica', 'last_name' => 'Hyde'];
        $joeDoe      = ['first_name' => 'Joe', 'last_name' => 'Doe'];

        $this->add(self::DB_TABLE, 5);
        $this->add(self::DB_TABLE, 1, $jessicaHyde);
        $this->add(self::DB_TABLE, 1, $joeDoe);

        $this->assertRowCount(self::DB_TABLE, 7);
        $this->assertRepositoryHasRows(self::DB_TABLE, [$jessicaHyde, $joeDoe]);
    }
}
