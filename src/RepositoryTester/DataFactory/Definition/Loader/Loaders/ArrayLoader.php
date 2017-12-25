<?php declare(strict_types=1);

namespace RepositoryTester\DataFactory\Definition\Loader\Loaders;

use RepositoryTester\DataFactory\Definition\Loader\AbstractLoader;
use RepositoryTester\DataFactory\Definition\Loader\LoaderInterface;

class ArrayLoader extends AbstractLoader
{
    /**
     * @param array $resource
     *
     * @return \RepositoryTester\DataFactory\Definition\Loader\LoaderInterface
     */
    public function load($resource): LoaderInterface
    {
        foreach ($resource as $identifier => $definition) {
            $this->container->add(
                $identifier,
                $this->createDefinition($definition)
            );
        }

        return $this;
    }
}
