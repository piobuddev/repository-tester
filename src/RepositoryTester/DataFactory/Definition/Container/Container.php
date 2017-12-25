<?php declare(strict_types=1);

namespace RepositoryTester\DataFactory\Definition\Container;

use RepositoryTester\DataFactory\Definition\DefinitionInterface;
use UnexpectedValueException;

class Container implements ContainerInterface
{
    /**
     * @var array
     */
    private $definitions = [];

    /**
     * @param string              $identifier
     * @param DefinitionInterface $definition
     */
    public function add(string $identifier, DefinitionInterface $definition): void
    {
        $this->definitions[$identifier] = $definition;
    }

    /**
     * @param string $identifier
     *
     * @return mixed
     */
    public function get(string $identifier): DefinitionInterface
    {
        if (!isset($this->definitions[$identifier])) {
            throw new UnexpectedValueException(sprintf('Undefined `%s` definition', $identifier));
        }

        return $this->definitions[$identifier];
    }
}
