<?php declare(strict_types=1);

namespace RepositoryTester\Test\DataFactory\Definition\Container;

use PHPUnit\Framework\TestCase;
use RepositoryTester\DataFactory\Definition\Container\Container;
use RepositoryTester\DataFactory\Definition\DefinitionInterface;
use UnexpectedValueException;

class ContainerTest extends TestCase
{
    /**
     * @var \RepositoryTester\DataFactory\Definition\Container\Container
     */
    private $cut;

    protected function setUp()
    {
        parent::setUp();

        $this->cut = new Container();
    }

    public function testReturnsExpectedDefinition()
    {
        /** @var \RepositoryTester\DataFactory\Definition\DefinitionInterface $definitionMock */
        $definitionMock = $this->createMock(DefinitionInterface::class);
        $identifier     = 'identifier';
        $this->cut->add($identifier, $definitionMock);

        $this->assertEquals($definitionMock, $this->cut->get($identifier));
    }

    public function testThrowsExceptionForUnknownIdentifier()
    {
        $this->expectException(UnexpectedValueException::class);

        $this->cut->get('unknown_identifier');
    }
}
