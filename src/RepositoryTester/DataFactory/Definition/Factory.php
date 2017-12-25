<?php declare(strict_types=1);

namespace RepositoryTester\DataFactory\Definition;

use RepositoryTester\DataFactory\Definition\Definitions\ArrayDefinition;
use RepositoryTester\DataFactory\Definition\Definitions\CallableDefinition;

class Factory
{
    /**
     * @param $definition
     *
     * @return \RepositoryTester\DataFactory\Definition\DefinitionInterface
     */
    public static function create($definition): DefinitionInterface
    {
        switch (true) {
            case is_callable($definition):
                return new CallableDefinition($definition);
            case is_array($definition):
            default:
                return new ArrayDefinition($definition);
        }
    }
}
