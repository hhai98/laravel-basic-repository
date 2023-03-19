## step 1

`composer require hoovhai/basic-repositories`

or add to `composer.json` and run `composer install`

```
"require-dev": {
    "hoovhai/basic-repositories": "dev-master"

},
```

## step 2
create `app/Providers/CommandsServiceProvider.php`

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

## step 3

add to `config\app.php`
```php
App\Providers\RepositoriesPackageServiceProvider::class,
App\Providers\RepositoriesServiceProvider::class,
```
## step 4
run `php artisan make:repository {name}`
Example:

`php artisan make:repository User`
