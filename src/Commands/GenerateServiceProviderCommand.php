<?php

namespace Hoovhai\Repositories\Commands;

use Hoovhai\Repositories\Commands\BaseGenerateCommand;

class GenerateServiceProviderCommand extends BaseGenerateCommand
{
    protected $inputType = 'Service-provider';
    protected $namespace = '\Providers';

    protected function getNameInput()
    {
        return 'RepositoriesServiceProvider';
    }
}
