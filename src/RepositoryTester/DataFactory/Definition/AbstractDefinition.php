<?php declare(strict_types=1);

namespace RepositoryTester\DataFactory\Definition;

abstract class AbstractDefinition implements DefinitionInterface
{
    /**
     * @var int
     */
    protected $times = 1;

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @return array
     */
    abstract public function build(): array;

    /**
     * @param int $times
     *
     * @return \RepositoryTester\DataFactory\Definition\DefinitionInterface
     */
    public function times(int $times): DefinitionInterface
    {
        $this->times = $times;

        return $this;
    }

    /**
     * @param array $attributes
     *
     * @return \RepositoryTester\DataFactory\Definition\DefinitionInterface
     */
    public function attributes(array $attributes): DefinitionInterface
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @return array
     */
    public function create(): array
    {
        $result = [];
        while ($this->times--) {
            $result[] = $this->build();
        }

        return $result;
    }
}
