<?php declare(strict_types=1);

namespace RepositoryTester\Test\DataFactory\Definition\Loader\Loaders;

use PHPUnit\Framework\TestCase;
use RepositoryTester\DataFactory\Definition\Container\Container;
use RepositoryTester\DataFactory\Definition\Definitions\ArrayDefinition;
use RepositoryTester\DataFactory\Definition\Loader\Loaders\ArrayLoader;

class ArrayLoaderTest extends TestCase
{
    /**
     * @var \RepositoryTester\DataFactory\Definition\Container\ContainerInterface
     */
    private $container;

    /**
     * @var array
     */
    private $definition = [];

    /**
     * @var \RepositoryTester\DataFactory\Definition\Loader\Loaders\ArrayLoader
     */
    private $cut;

    protected function setUp()
    {
        parent::setUp();

        $this->container  = new Container();
        $this->cut        = new ArrayLoader($this->container);
        $this->definition = [
            'id-1' => [1, 2, 3],
            'id-2' => [4, 5, 6],
        ];
    }

    public function testLoadsExpectedData()
    {
        $this->cut->load($this->definition);

        $definition = $this->container->get('id-1');
        $this->assertInstanceOf(ArrayDefinition::class, $definition);
        $this->assertEquals($this->definition['id-1'], $definition->create()[0]);

        $definition = $this->container->get('id-2');
        $this->assertInstanceOf(ArrayDefinition::class, $definition);
        $this->assertEquals($this->definition['id-2'], $definition->create()[0]);
    }
}
