<?php declare(strict_types=1);

namespace RepositoryTester\Test\DataFactory\Factories\Faker;

use Faker\Factory;
use PHPUnit\Framework\TestCase;
use RepositoryTester\DataFactory\Definition\Container\Container;
use RepositoryTester\DataFactory\Definition\Loader\Loaders\ArrayLoader;
use RepositoryTester\DataFactory\Factories\Faker\FakerDataFactory;

class FakerDataFactoryTest extends TestCase
{
    private const IDENTIFIER = 'id-1';

    /**
     * @var FakerDataFactory
     */
    private $cut;

    /**
     * @var array
     */
    private $names = ['Joe', 'Lucy', 'Lexi'];

    /**
     * @var array
     */
    private $lastNames = ['Weber', 'Jones', 'Doe'];

    protected function setUp()
    {
        parent::setUp();

        $generator = Factory::create();
        $container = new Container();
        $loader    = new ArrayLoader($container);
        $loader->load(
            [
                self::IDENTIFIER => function (\Faker\Generator $faker, array $args = []) {
                    return array_merge(
                        [
                            'first_name' => $faker->randomElement($this->names),
                            'last_name'  => $faker->randomElement($this->lastNames),
                        ],
                        $args
                    );
                },
            ]
        );

        $this->cut = new FakerDataFactory($generator, $container);
    }

    public function testReturnsExpectedData()
    {
        $result = $this->cut->create(self::IDENTIFIER);

        $this->assertArrayHasKey(self::IDENTIFIER, $result);
        $this->assertCount(1, $result[self::IDENTIFIER]);

        $row = $result[self::IDENTIFIER][0];

        $this->assertTrue(in_array($row['first_name'], $this->names));
        $this->assertTrue(in_array($row['last_name'], $this->lastNames));
    }

    public function testCreatesMultipleRows()
    {
        $result = $this->cut->create(self::IDENTIFIER, 3);

        $this->assertArrayHasKey(self::IDENTIFIER, $result);
        $this->assertCount(3, $result[self::IDENTIFIER]);
    }

    public function testOverridesFakersData()
    {
        $result = $this->cut->create(self::IDENTIFIER, 1, ['first_name' => 'Mia']);

        $this->assertArrayHasKey(self::IDENTIFIER, $result);
        $this->assertCount(1, $result[self::IDENTIFIER]);

        $this->assertEquals('Mia', $result[self::IDENTIFIER][0]['first_name']);
    }
}
