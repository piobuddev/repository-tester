<?php declare(strict_types=1);

namespace RepositoryTester\Test\Helpers;

use Faker\Factory;
use PDO;
use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestListenerDefaultImplementation;
use PHPUnit\Framework\TestSuite;
use RepositoryTester\DataFactory\DataFactoryAwareInterface;
use RepositoryTester\DataFactory\Definition\Container\Container;
use RepositoryTester\DataFactory\Definition\Loader\Loaders\PhpFileLoader;
use RepositoryTester\DataFactory\Factories\Faker\FakerDataFactory;
use RepositoryTester\Repository\Connection\ConnectionInterface;
use RepositoryTester\Repository\Database\Adapters\DbUnitConnectionAdapter;
use RepositoryTester\Repository\RepositoryAwareInterface;

class RepositoryAwareTestListener implements TestListener
{
    use TestListenerDefaultImplementation;

    /**
     * @var \RepositoryTester\Repository\Connection\ConnectionInterface
     */
    private $connection;

    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @var array
     */
    private $config;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param \PHPUnit\Framework\Test $test
     */
    public function startTest(Test $test)
    {
        if ($test instanceof RepositoryAwareInterface) {
            $this->configureDatabaseAwareTest($test);
        }

        if ($test instanceof DataFactoryAwareInterface) {
            $this->configureDataFactoryTest($test);
        }
    }

    public function endTestSuite(TestSuite $suite)
    {
        $this->closeConnection();
    }

    /**
     * @param \RepositoryTester\Repository\RepositoryAwareInterface $test
     */
    private function configureDatabaseAwareTest(RepositoryAwareInterface $test): void
    {
        $test->setConnection($this->getConnection());
    }

    /**
     * @param \RepositoryTester\DataFactory\DataFactoryAwareInterface $test
     */
    private function configureDataFactoryTest(DataFactoryAwareInterface $test): void
    {
        $generator = Factory::create();
        $container = new Container();
        $loader    = new PhpFileLoader($container, $this->config['database']['definition']['path']);
        $loader->load($this->config['database']['definition']['file']);

        $test->setDataFactory(new FakerDataFactory($generator, $container));
    }

    /**
     * @return \RepositoryTester\Repository\Connection\ConnectionInterface
     */
    private function getConnection(): ConnectionInterface
    {
        if (null === $this->connection) {
            $this->createDb();
            $this->connection = new DbUnitConnectionAdapter($this->pdo);
        }

        return $this->connection;
    }

    private function closeConnection(): void
    {
        if (isset($this->connection)) {
            $this->getConnection()->close();
            unset($this->connection, $this->pdo);
        }

        return;
    }

    private function createDb(): void
    {
        $table = $this->config['database']['tableName'];
        $sql   = "CREATE TABLE IF NOT EXISTS {$table} (
                id integer PRIMARY KEY,
                first_name text NOT NULL,
                last_name text NOT NULL
              )";

        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->query($sql);
    }
}
