<?php declare(strict_types=1);

namespace RepositoryTester\DataFactory;

use RepositoryTester\DataFactory\FactoryInterface;

interface DataFactoryAwareInterface
{
    /**
     * @param \RepositoryTester\DataFactory\FactoryInterface $factory
     */
    public function setDataFactory(FactoryInterface $factory): void;
}
