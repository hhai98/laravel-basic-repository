<?php

namespace Hoovhai\Repositories\Commands;

use Illuminate\Console\Command;

class MakeRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make basic repository design pattern';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->callGenerateCommand('repository');
        $this->callGenerateCommand('contract');
        $this->callGenerateCommand('controller');

        $this->addToServiceContainer();
        $this->info('All done, enjoy!');
    }

    /**
     * Call the console generate
     *
     * @var string
     */
    private function callGenerateCommand(string $name)
    {
        try {
            $this->callSilent("create:$name", ['name' => $this->argument('name')]);
            $this->info("Create $name success !");
        } catch (\Exception $e) {
            $this->error("Create $name failed !");
            throw $e;
        }
    }

    /**
     * Bind new contract and repository to RepositoriesServiceProvider
     *
     */
    private function addToServiceContainer()
    {
        $name = str_replace('/', '\\', $this->argument('name'));
        $serviceProviderPath = base_path() . '/app/Providers/RepositoriesServiceProvider.php';

        if (!file_exists($serviceProviderPath)) {
            $this->callGenerateCommand('service-provider');
        }

        $file = fopen($serviceProviderPath, 'r');
        $lineFile = [];
        while(! feof($file)) {
            $lineFile[] = fgets($file);
        }
        fclose($file);

        $check = $write = $push = false;
        // make regex
        $regex = '.+App.+Contracts.+' . $name . 'Contract::class, .+App.+Repositories.+' . $name . 'Repository::class';
        
        foreach ($lineFile as $key => $line) {
            // check old file RepositoriesServiceProvider have Contract and Repository yet ?
            if (preg_match("/$regex/", $line)) {
                break;
            }
            if ($push) {
                $lineFile[++$key] = $line;
                continue;
            }
            if ($write) {
                //create new line in RepositoriesServiceProvider
                $lineFile[++$key] =  '        $this->app->singleton(' . str_replace('.+', '\\', $regex)  . "); \r\n";
                $push = true;
                $write = $check = false;
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
