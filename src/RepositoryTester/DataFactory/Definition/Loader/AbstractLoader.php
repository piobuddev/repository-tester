<?php declare(strict_types=1);

namespace RepositoryTester\DataFactory\Definition\Loader;

use RepositoryTester\DataFactory\Definition\Container\ContainerInterface;
use RepositoryTester\DataFactory\Definition\Factory;

abstract class AbstractLoader implements LoaderInterface
{
    /**
     * @var \RepositoryTester\DataFactory\Definition\Container\ContainerInterface
     */
    protected $container;

    /**
     * @param \RepositoryTester\DataFactory\Definition\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param mixed $definition
     *
     * @return mixed
     */
    protected function createDefinition($definition)
    {
        return Factory::create($definition);
    }
}
