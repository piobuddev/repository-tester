# Repository Tester

Repository tester is a set of tools (Data factory, DB client) that will help you test your repositories. 

## Usage
In your `composer.json` file:
```json
    {
        "repositories": [
            {
                "type": "git",
                "url": "https://github.com/piobuddev/repository-tester.git"
            }
        ],
        "require-dev": {
            "piobuddev/repository-tester": "^1.0.0"
        }
    }
```
- install or update composer
```sh
$ composer install "piobuddev/repository-tester"
```

One way to integrate `Repository Tester` with your tests is through [PHPUnit listener](https://phpunit.de/manual/6.5/en/extending-phpunit.html)

Example:
```php
use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestListenerDefaultImplementation;
   
class RepositoryAwareTestListener implements TestListener
{
    use TestListenerDefaultImplementation;
    
    public function __construct(array $config)
    {
        $this->config = $config;
    }    
        
    public function startTest(Test $test)
    {
        if ($test instanceof RepositoryAwareInterface) {
            
            // ...get the attributes from the config...
            
            $connection = new DbUnitConnectionAdapter(
                new PDO($dns, $username, $password, $options)
            );
            
            $test->setConnection($connection);
        }
    }
}
```

```php
class SomeTest implements RepositoryAwareInterface
{
    use RepositoryAssertTrait;
    
    public function tearDown()
    {
        $this->clearTables();
        parent::tearDown();
    }
    
    public function testSomething()
    {
        $data = ['tableName' => ['column1' => 'value'1]];
        $insertedDate = $this->insert($data);
        
        //... do something
    }
    
}

```

## Development setup:
### Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites
* PHP >= `7.1`
* MySQL `5.7`
* [Composer](https://getcomposer.org/): tool for dependency management in PHP

### Installing

To get the development environment running clone the repository and run the composer

```sh
$ git clone git@github.com:piobuddev/repository-tester.git
$ cd repository-tester/
$ composer install
```

## Running the tests

##### PHPUNIT

```sh
$ vendor/bin/phpunit 
```

### Coding style tests
##### PHPStan : PHP Static Analysis Tool

```sh
$ vendor/bin/phpstan analyse -l 7 src tests -c phpstan.neon
```
##### PHPCS : Detects violations of a defined set of coding standards

```sh
$ vendor/bin/phpcs --standard=PSR2 --extensions=php --colors --severity=1 src
```

or run all tests together with:
```sh
$ composer test
```

Additionaly you can fix code formatting with:
##### PHPCBF : PHP Code Beautifier and Fixer

```sh
$ vendor/bin/phpcbf --standard=PSR2 --extensions=php --colors --severity=1 src
```

## Built With

* [PHPUnit](https://phpunit.de/) - PHPUnit is a programmer-oriented testing framework for PHP
* [DBUnit](https://github.com/sebastianbergmann/dbunit) - PHPUnit extension for database interaction testing
* [Faker](https://github.com/fzaninotto/Faker) - Faker is a PHP library that generates fake data for you

## Code Style
* [PSR2](https://www.php-fig.org/psr/psr-2/)


## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/piobuddev/c04b7341f68da9718907cb593012d746) for details on my code of conduct, and the process for submitting pull requests to me.

## Versioning

I use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Piotr Budny** - [piobuddev](https://github.com/piobuddev)

## License

This project is licensed under the MIT License - see the [LICENSE.md](https://github.com/piobuddev/repository-tester/blob/master/LICENSE.md) file for details
