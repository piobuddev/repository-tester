<?php declare(strict_types=1);

namespace RepositoryTester\DataFactory\Definition;

interface DefinitionInterface
{
    /**
     * @param int $times
     *
     * @return \RepositoryTester\DataFactory\Definition\DefinitionInterface
     */
    public function times(int $times): DefinitionInterface;

    /**
     * @param array $attributes
     *
     * @return \RepositoryTester\DataFactory\Definition\DefinitionInterface
     */
    public function attributes(array $attributes): DefinitionInterface;

    /**
     * @return array
     */
    public function create(): array;
}
