<?php

namespace Hoovhai\Repositories\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;

class BaseGenerateCommand extends GeneratorCommand
{
    protected $baseNamespace = '';
    protected $baseNameInput = '';
    protected $name = '';

    public function __construct(Filesystem $files)
    {
        $this->name = 'create:' . strtolower($this->baseNamespace) . ' {name}';

        parent::__construct($files);
    }

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
