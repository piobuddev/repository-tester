<?php declare(strict_types=1);

namespace RepositoryTester\DataFactory\Definition\Definitions;

use RepositoryTester\DataFactory\Definition\AbstractDefinition;

class CallableDefinition extends AbstractDefinition
{
    /**
     * @var callable
     */
    private $definition;

    /**
     * @param callable $definition
     */
    public function __construct(callable $definition)
    {
        $this->definition = $definition;
    }

    /**
     * @return array
     */
    public function build(): array
    {
        return call_user_func($this->definition, ...$this->attributes);
    }
}
