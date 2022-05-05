<?php

namespace Bakgul\Packagify;

use Bakgul\Kernel\Concerns\HasConfig;
use Illuminate\Support\ServiceProvider;

class PackagifyServiceProvider extends ServiceProvider
{
    use HasConfig;
    
    public function boot()
    {
        $this->commands([
            \Bakgul\Packagify\Commands\BuildPackagifiedLaravelCommand::class,
        ]);
    }

    public function register()
    {
        $this->registerConfigs(__DIR__ . DIRECTORY_SEPARATOR . '..');
    }
}
