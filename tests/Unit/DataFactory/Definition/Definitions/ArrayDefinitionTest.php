<?php declare(strict_types=1);

namespace RepositoryTester\Test\DataFactory\Definition\Definitions;

use PHPUnit\Framework\TestCase;
use RepositoryTester\DataFactory\Definition\Definitions\ArrayDefinition;

class ArrayDefinitionTest extends TestCase
{
    /**
     * @var \RepositoryTester\DataFactory\Definition\Definitions\ArrayDefinition
     */
    private $cut;

    protected function setUp()
    {
        parent::setUp();

        $this->cut = new ArrayDefinition(['a', 'b', 'c']);
    }

    public function testMergesAttributes()
    {
        $attributes = ['d', 'e'];
        $result     = $this->cut
            ->attributes($attributes)
            ->create();

        $this->assertEquals(['a', 'b', 'c', 'd', 'e'], array_pop($result));
    }

    public function testCreatesOneDefinitionByDefault()
    {
        $this->assertCount(1, $this->cut->create());
    }

    public function testCreatesMultipleDefinitions()
    {
        $this->assertCount(3, $this->cut->times(3)->create());
    }
}
