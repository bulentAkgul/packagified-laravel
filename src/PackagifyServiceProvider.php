<?php

namespace Bakgul\Packagify;

use Illuminate\Support\ServiceProvider;

class PackagifyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([
            \Bakgul\Packagify\Commands\BuildPackagifiedLaravelCommand::class,
        ]);
    }

    public function register()
    {
        //
    }
}
