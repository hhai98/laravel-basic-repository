<?php

namespace Hoovhai\Repositories\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeRepositoryCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make repository';

        /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/Stubs/repository.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Repositories';
    }

    protected function getNameInput()
    {
        return trim($this->argument('name')) . 'Repository';
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
