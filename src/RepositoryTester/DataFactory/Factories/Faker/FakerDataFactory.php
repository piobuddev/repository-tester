<?php declare(strict_types=1);

namespace RepositoryTester\DataFactory\Factories\Faker;

use Faker\Generator;
use RepositoryTester\DataFactory\Definition\Container\ContainerInterface;
use RepositoryTester\DataFactory\FactoryInterface;

class FakerDataFactory implements FactoryInterface
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    /**
     * @var \RepositoryTester\DataFactory\Definition\Container\ContainerInterface
     */
    private $container;

    /**
     * @param \Faker\Generator                                                      $generator
     * @param \RepositoryTester\DataFactory\Definition\Container\ContainerInterface $container
     */
    public function __construct(Generator $generator, ContainerInterface $container)
    {
        $this->faker     = $generator;
        $this->container = $container;
    }

    /**
     * @param string $identifier
     * @param int    $times
     * @param array  $arguments
     *
     * @return array
     */
    public function create(string $identifier, int $times = 1, array $arguments = []): array
    {
        $definition = $this->container
            ->get($identifier)
            ->times($times)
            ->attributes([$this->faker, $arguments]);

        return [$identifier => $definition->create()];
    }
}
