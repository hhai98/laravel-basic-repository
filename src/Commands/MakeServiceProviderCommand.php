<?php

namespace Hoovhai\Repositories\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeServiceProviderCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:service-provider';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make service provider';

        /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/Stubs/service.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Providers';
    }
}
