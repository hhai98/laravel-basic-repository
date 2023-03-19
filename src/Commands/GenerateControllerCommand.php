<?php

namespace Hoovhai\Repositories\Commands;

use Hoovhai\Repositories\Commands\BaseGenerateCommand;

class GenerateControllerCommand extends BaseGenerateCommand
{
    protected $inputType = 'Controller';
    protected $namespace = '\Http\Controllers';
}
