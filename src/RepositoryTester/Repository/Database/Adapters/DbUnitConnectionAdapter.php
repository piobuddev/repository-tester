<?php declare(strict_types=1);

namespace RepositoryTester\Repository\Database\Adapters;

use PHPUnit\DbUnit\Database\DefaultConnection;
use PHPUnit\DbUnit\DataSet\ArrayDataSet;
use PHPUnit\DbUnit\DataSet\ITable;
use PHPUnit\DbUnit\Operation\Factory;
use RepositoryTester\Repository\Connection\ConnectionInterface;

class DbUnitConnectionAdapter extends DefaultConnection implements ConnectionInterface
{
    public function close(): void
    {
        //fix for issue #203
        $this->metaData = null;

        parent::close();
    }

    /**
     * @param string     $entity
     * @param array|null $arguments
     *
     * @return array
     */
    public function fetchAll(string $entity, array $arguments = null): array
    {
        $table = $this->createDataSet([$entity])->getTable($entity);

        return $this->tableToArray($table);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function insert(array $data): array
    {
        $dataSet = new ArrayDataSet($data);
        (new Factory())::INSERT()->execute($this, $dataSet);

        return $this->fetchAll($dataSet->getTableNames()[0]);
    }

    /**
     * @param string $entity
     * @param array  $args
     *
     * @return int
     */
    public function count(string $entity, array $args = []): int
    {
        $where = null;
        if (!empty($args['where'])) {
            $where = $this->implodeWhere($args['where']);
        }

        return $this->getRowCount($entity, $where);
    }

    /**
     * @param array|null $entities
     *
     * @return \RepositoryTester\Repository\Connection\ConnectionInterface
     */
    public function clear(array $entities = null): ConnectionInterface
    {
        (new Factory())::TRUNCATE()->execute($this, $this->createDataSet($entities));

        return $this;
    }

    /**
     * @param array  $where
     * @param string $glue
     *
     * @return string
     */
    private function implodeWhere(array $where, string $glue = ' AND '): string
    {
        array_walk(
            $where,
            function (&$v, $k) {
                $v = "`{$k}`='{$v}'";
            }
        );

        return implode($glue, $where);
    }

    /**
     * @param \PHPUnit\DbUnit\DataSet\ITable $table
     *
     * @return array
     */
    private function tableToArray(ITable $table): array
    {
        if (1 === $table->getRowCount()) {
            return $table->getRow(0);
        }

        $result = [];
        for ($i = 0; $i < $table->getRowCount(); $i++) {
            $result[] = $table->getRow($i);
        }

        return $result;
    }
}
