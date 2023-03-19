<?php

namespace Hoovhai\Repositories\Commands;

use Hoovhai\Repositories\Commands\BaseGenerateCommand;

class GenerateContractCommand extends BaseGenerateCommand
{
    protected $inputType = 'Contract';
    protected $namespace = '\Contracts';
}
