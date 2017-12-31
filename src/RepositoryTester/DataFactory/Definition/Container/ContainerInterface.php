<?php declare(strict_types=1);

namespace RepositoryTester\DataFactory\Definition\Container;

use RepositoryTester\DataFactory\Definition\DefinitionInterface;

interface ContainerInterface
{
    /**
     * @param string $identifier
     *
     * @return \RepositoryTester\DataFactory\Definition\DefinitionInterface
     */
    public function get(string $identifier): DefinitionInterface;

    /**
     * @param string              $identifier
     * @param DefinitionInterface $definition
     */
    public function add(string $identifier, DefinitionInterface $definition): void;
}
