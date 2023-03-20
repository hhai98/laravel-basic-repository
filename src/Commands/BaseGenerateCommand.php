<?php

namespace Hoovhai\Repositories\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;

class BaseGenerateCommand extends GeneratorCommand
{
    protected $inputType = '';
    protected $namespace = '';
    protected $name = '';

    public function __construct(Filesystem $file)
    {
        $this->name = 'create:' . strtolower($this->inputType) . ' {name}';

        parent::__construct($file);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '//Stubs//' . strtolower($this->inputType) . '.stub';
    }

    /**
     * Get the default namespace for the generator.
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . $this->namespace;
    }

    /**
     * Get the name input for the generator.
     *
     * @return string
     */
    protected function getNameInput()
    {
        return trim($this->argument('name')) . $this->inputType;
    }

    /**
     * Check and replace DummyName in stub
     *
     */
    protected function replaceNamespace(&$stub, $name)
    {
        parent::replaceNamespace($stub, $name);
        
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
