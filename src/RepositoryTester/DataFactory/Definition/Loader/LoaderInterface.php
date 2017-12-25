<?php declare(strict_types=1);

namespace RepositoryTester\DataFactory\Definition\Loader;

interface LoaderInterface
{
    /**
     * @param mixed $resource
     *
     * @return \RepositoryTester\DataFactory\Definition\Loader\LoaderInterface
     * @throws \Exception
     */
    public function load($resource): LoaderInterface;
}
