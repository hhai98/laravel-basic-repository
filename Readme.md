First Step.
composer require hoovhai/basic-repositories.

or add to composer.json and run composer install.
"require-dev": {.
    "hoovhai/basic-repositories": "dev-master".
},.

create "app/Providers/CommandsServiceProvider.php"

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CommandsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Hoovhai\Repositories\Commands\GenerateRepositoryCommand::class,
                \Hoovhai\Repositories\Commands\MakeContractCommand::class,
                \Hoovhai\Repositories\Commands\MakeControllerCommand::class,
                \Hoovhai\Repositories\Commands\MakeRepositoryCommand::class,
                \Hoovhai\Repositories\Commands\MakeServiceProviderCommand::class,
            ]);
        }
    }
}
```

