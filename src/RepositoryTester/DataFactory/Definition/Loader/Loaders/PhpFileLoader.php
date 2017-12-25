<?php declare(strict_types=1);

namespace RepositoryTester\DataFactory\Definition\Loader\Loaders;

use RepositoryTester\DataFactory\Definition\Loader\AbstractFileLoader;
use UnexpectedValueException;

class PhpFileLoader extends AbstractFileLoader
{
    /**
     * @param $file
     *
     * @return array
     */
    protected function loadConfiguration($file): array
    {
        if ('php' !== pathinfo($file, PATHINFO_EXTENSION)) {
            throw new UnexpectedValueException(sprintf('File `%s` needs to be .php', $file));
        }

        if (!file_exists($definitions = $this->path . '/' . $file)) {
            throw new UnexpectedValueException(
                sprintf('Definitions file `%s` does not exist', $file)
            );
        }

        return include $definitions;
    }
}
