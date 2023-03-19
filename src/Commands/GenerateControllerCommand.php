<?php

namespace Hoovhai\Repositories\Commands;

use Hoovhai\Repositories\Commands\BaseGenerateCommand;

class GenerateControllerCommand extends BaseGenerateCommand
{
    protected $baseNamespace = 'Controller';
    protected $baseNameInput = '\Http\Controllers';
}
