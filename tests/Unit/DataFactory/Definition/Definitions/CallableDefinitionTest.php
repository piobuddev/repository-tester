<?php declare(strict_types=1);

namespace RepositoryTester\Test\DataFactory\Definition\Definitions;

use PHPUnit\Framework\TestCase;
use RepositoryTester\DataFactory\Definition\Definitions\CallableDefinition;

class CallableDefinitionTest extends TestCase
{
    /**
     * @var \RepositoryTester\DataFactory\Definition\Definitions\CallableDefinition
     */
    private $cut;

    protected function setUp()
    {
        parent::setUp();

        $this->cut = new CallableDefinition([$this, 'callableDefinition']);
    }

    public function testPassesAttributes()
    {
        $attributes = ['a', 'b', 'c'];
        $result     = $this->cut
            ->attributes($attributes)
            ->create();

        $this->assertEquals($attributes, array_pop($result));
    }

    public function testCreatesOneDefinitionByDefault()
    {
        $this->assertCount(1, $this->cut->create());
    }

    public function testCreatesMultipleDefinitions()
    {
        $this->assertCount(3, $this->cut->times(3)->create());
    }

    public function callableDefinition()
    {
        return func_get_args();
    }
}
