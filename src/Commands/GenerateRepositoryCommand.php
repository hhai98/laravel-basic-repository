<?php

namespace Hoovhai\Repositories\Commands;

use Hoovhai\Repositories\Commands\BaseGenerateCommand;

class GenerateRepositoryCommand extends BaseGenerateCommand
{
    protected $baseNamespace = 'Repository';
    protected $baseNameInput = '\Repositories';
}
