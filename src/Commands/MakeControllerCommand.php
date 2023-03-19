<?php

namespace Hoovhai\Repositories;

use Illuminate\Console\GeneratorCommand;

class MakeControllerCommand extends GeneratorCommand
{
    protected $name = 'create:controller {name} {nameSpaceContract}';

    protected $description = 'Create a controller';

    protected function getStub()
    {
        return __DIR__.'/Stubs/controller.stub';
    }

    protected function getNameInput()
    {
        return trim($this->argument('name')) . 'Controller';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Controllers';
    }

    protected function replaceNamespace(&$stub, $name)
    {
        $ArrNameContract = explode('/', $this->argument('name'));
        $lastName = array_pop($ArrNameContract)  . 'Contract';
        $nameSpace = '';
        foreach ($ArrNameContract as $nameContract) {
            $nameSpace .= "$nameContract\\";
        }

        $stub = str_replace(
            [
                'DummyContract',
            ],
            [
                $nameSpace . $lastName,
            ],
            $stub
        );

        return $this;
    }
}
