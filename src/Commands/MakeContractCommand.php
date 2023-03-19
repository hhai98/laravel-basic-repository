<?php

namespace Hoovhai\Repositories;

use Illuminate\Console\GeneratorCommand;
use \Illuminate\Filesystem\Filesystem;

class MakeContractCommand extends GeneratorCommand
{
    protected $name = 'create:contract {name}';
    protected $baseName = '';
    protected $nameSpace = '';

    protected $description = 'Create a contract interface';

    protected function getStub()
    {
        return __DIR__.'/Stubs/contract.stub';
    }

    protected function getNameInput()
    {
        return trim($this->argument('name')) . 'Contract';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        $this->nameSpace = $rootNamespace.'\Contracts';
        return $this->nameSpace;
    }
}
