<?php

namespace Bakgul\Packagify\Commands;

use Bakgul\Kernel\Concerns\HasPreparation;
use Bakgul\Kernel\Concerns\HasRequest;
use Bakgul\Kernel\Helpers\Settings;
use Bakgul\Packagify\Services\PackagifyService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class BuildPackagifiedLaravelCommand extends Command
{
    use HasPreparation, HasRequest;

    protected $signature = 'build-pl';
    protected $description = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->prepareRequest();

        Settings::standalone('package')
            ? Artisan::call('create:package')
            : PackagifyService::create($this->request);
    }
}
