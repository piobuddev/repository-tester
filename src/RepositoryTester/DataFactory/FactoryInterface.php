<?php declare(strict_types=1);

namespace RepositoryTester\DataFactory;

interface FactoryInterface
{
    /**
     * @param string $name
     * @param int    $times
     * @param array  $arguments
     *
     * @return mixed
     */
    public function create(string $name, int $times, array $arguments = []);
}
