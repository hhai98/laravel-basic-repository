<?php

namespace Hoovhai\Repositories\Commands;

use Hoovhai\Repositories\Commands\BaseGenerateCommand;

class GenerateContractCommand extends BaseGenerateCommand
{
    protected $baseNamespace = 'Contract';
    protected $baseNameInput = '\Contracts';
    protected $name = 'create:contract {name}';
}
