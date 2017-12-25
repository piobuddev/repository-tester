<?php declare(strict_types=1);

namespace RepositoryTester\DataFactory;

trait DataFactoryAwareTrait
{
    /**
     * @var \RepositoryTester\DataFactory\FactoryInterface
     */
    private $factory;

    /**
     * @return \RepositoryTester\DataFactory\FactoryInterface
     */
    public function getDataFactory(): FactoryInterface
    {
        return $this->factory;
    }

    /**
     * @param \RepositoryTester\DataFactory\FactoryInterface $factory
     */
    public function setDataFactory(FactoryInterface $factory): void
    {
        $this->factory = $factory;
    }
}
