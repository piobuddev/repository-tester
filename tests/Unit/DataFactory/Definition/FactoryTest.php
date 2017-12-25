<?php declare(strict_types=1);

namespace RepositoryTester\Test\DataFactory\Definition;

use PHPUnit\Framework\TestCase;
use RepositoryTester\DataFactory\Definition\Definitions\ArrayDefinition;
use RepositoryTester\DataFactory\Definition\Definitions\CallableDefinition;
use RepositoryTester\DataFactory\Definition\Factory;

class FactoryTest extends TestCase
{
    /**
     * @dataProvider LoaderToDefinitionMappingProvider
     */
    public function testCreatesExpectedDefinition($expected, $definition)
    {
        $definition = Factory::create($definition);

        $this->assertInstanceOf($expected, $definition);
    }

    public function LoaderToDefinitionMappingProvider(): array
    {
        return [
            'callable' => [CallableDefinition::class, [$this, 'call']],
            'array'    => [ArrayDefinition::class, [1, 2, 3]],
            'default'  => [ArrayDefinition::class, [1, 2, 3]],
        ];
    }

    public function call(): void
    {
        return;
    }
}