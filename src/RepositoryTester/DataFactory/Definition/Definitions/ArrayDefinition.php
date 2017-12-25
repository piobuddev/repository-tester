<?php declare(strict_types=1);

namespace RepositoryTester\DataFactory\Definition\Definitions;

use RepositoryTester\DataFactory\Definition\AbstractDefinition;

class ArrayDefinition extends AbstractDefinition
{
    /**
     * @var array
     */
    private $definition;

    /**
     * @param array $definition
     */
    public function __construct(array $definition)
    {
        $this->definition = $definition;
    }

    /**
     * @return array
     */
    public function build(): array
    {
        return array_merge($this->definition, $this->attributes);
    }
}
