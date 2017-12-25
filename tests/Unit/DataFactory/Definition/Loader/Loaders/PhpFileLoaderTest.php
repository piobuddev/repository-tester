<?php declare(strict_types=1);

namespace RepositoryTester\Test\DataFactory\Definition\Loader\Loaders;

use PHPUnit\Framework\TestCase;
use RepositoryTester\DataFactory\Definition\Container\Container;
use RepositoryTester\DataFactory\Definition\Definitions\CallableDefinition;
use RepositoryTester\DataFactory\Definition\Loader\Loaders\PhpFileLoader;
use UnexpectedValueException;

class PhpFileLoaderTest extends TestCase
{
    private const TEST_FILE_NAME = 'test_definition.php';

    /**
     * @var \RepositoryTester\DataFactory\Definition\Container\Container
     */
    private $container;

    /**
     * @var PhpFileLoader
     */
    private $cut;

    protected function setUp()
    {
        parent::setUp();

        $this->container = new Container();
        $this->cut       = new PhpFileLoader($this->container, __DIR__);
    }

    public function testThrowExceptionForWrongFileType()
    {
        $this->expectException(UnexpectedValueException::class);

        $this->cut->load('some_file.wrong');
    }

    public function testThrowExceptionForNotExistingFile()
    {
        $this->expectException(UnexpectedValueException::class);

        $this->cut->load('some_file.php');
    }

    public function testLoadsExpectedData()
    {
        $this->cut->load(self::TEST_FILE_NAME);

        $definition = $this->container->get('id-1');
        $this->assertInstanceOf(CallableDefinition::class, $definition);
        $this->assertEquals([1, 2, 3], $definition->create()[0]);

        $definition = $this->container->get('id-2');
        $this->assertInstanceOf(CallableDefinition::class, $definition);
        $this->assertEquals([4, 5, 3], $definition->attributes([4, 5])->create()[0]);
    }

    public function testThrowErrorForWrongDirectory()
    {
        $this->expectException(UnexpectedValueException::class);

        new PhpFileLoader($this->container, 'some/dir');
    }
}
