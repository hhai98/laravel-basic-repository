<?php

namespace Hoovhai\Repositories\Commands;

use Illuminate\Console\Command;

class GenerateRepositoryCommand extends Command
{
    protected $signature = 'make:repository {name}';

    protected $description = 'Generate repository contract and implementation';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->addToServiceContainer();

        $this->callSilent('create:repository', ['name' => $this->argument('name')]);
        $this->callSilent('create:contract', ['name' => $this->argument('name')]);
        $this->callSilent('create:controller', ['name' => $this->argument('name')]);

        $this->info('Create Repository Success !');
    }

    private function addToServiceContainer()
    {
        $name = str_replace('/', '\\', $this->argument('name'));
        $serviceProviderPath = base_path() . '/app/Providers/RepositoriesServiceProvider.php';

        if (!file_exists($serviceProviderPath)) {
            $this->callSilent('create:service-provider');
        }

        $file = fopen($serviceProviderPath, 'r');
        $lineFile = [];
        while(! feof($file)) {
            $lineFile[] = fgets($file);
        }
        fclose($file);

        $check = false;
        $write = false;
        $push = false;

        foreach ($lineFile as $key => $line) {
            if ($push) {
                $lineFile[++$key] = $line;
                continue;
            }
            if ($write) {
                $lineFile[++$key] = '        $this->app->singleton(\App\Contracts\\' . $name . 'Contract::class, \App\Repositories\\' . $name . 'Repository::class);' . "\r\n";
                $push = true;
                $write = false;
                $check = false;
                continue;
            }
            if ($check) {
                $write = true;
            }
            if (!$check && preg_match('/public function register()/', $line)) {
                $check = true;
            }
        }

        $file = fopen($serviceProviderPath, 'w');
        foreach ($lineFile as $key => $line) {
            fwrite($file, $line);
        }
        fclose($file);
    }
}
