<?php

namespace Hoovhai\Repositories\Commands;

use Illuminate\Console\GeneratorCommand;

class BaseGenerateCommand extends GeneratorCommand
{
    protected $baseNamespace = '';
    protected $baseNameInput = '';

        /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '//Stubs//' . strtolower($this->baseNamespace) . '.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . $this->baseNamespace;
    }

    protected function getNameInput()
    {
        return trim($this->argument('name')) . $this->baseNameInput;
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
                'DummyContractNamespace',
                'DummyContract',
            ],
            [
                $nameSpace . $lastName,
                $lastName,
            ],
            $stub
        );

        return $this;
    }
}
