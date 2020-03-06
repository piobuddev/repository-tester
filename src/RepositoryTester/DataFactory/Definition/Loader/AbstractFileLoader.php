<?php declare(strict_types=1);

namespace RepositoryTester\DataFactory\Definition\Loader;

use RepositoryTester\DataFactory\Definition\Container\ContainerInterface;
use UnexpectedValueException;

abstract class AbstractFileLoader extends AbstractLoader
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @param $resource
     *
     * @return array
     */
    abstract protected function loadConfiguration($resource): array;

    /**
     * @param \RepositoryTester\DataFactory\Definition\Container\ContainerInterface $container
     * @param string                                                                $path
     */
    public function __construct(ContainerInterface $container, string $path)
    {
        if (!file_exists($path)) {
            throw new UnexpectedValueException(sprintf('Definitions path: `%s` does not exist', $path));
        }

        $this->path = $path;

        parent::__construct($container);
    }

    /**
     * @param mixed $resource
     *
     * @return \RepositoryTester\DataFactory\Definition\Loader\LoaderInterface
     */
    public function load($resource): LoaderInterface
    {
        foreach ($this->loadConfiguration($resource) as $identifier => $definition) {
            $this->container->add(
                $identifier,
                $this->createDefinition($definition)
            );
        }

        return $this;
    }
}
