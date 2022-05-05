<?php

namespace Bakgul\Packagify\Commands;

use Bakgul\FileHistory\Concerns\HasHistory;
use Bakgul\Kernel\Concerns\HasPreparation;
use Bakgul\Kernel\Concerns\HasRequest;
use Bakgul\Kernel\Tasks\SimulateArtisanCall;
use Bakgul\Kernel\Helpers\Settings;
use Bakgul\Packagify\Services\PackagifyService;
use Illuminate\Console\Command;

class BuildPackagifiedLaravelCommand extends Command
{
    use HasHistory, HasPreparation, HasRequest;

    protected $signature = 'build-pl';
    protected $description = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->prepareRequest();

        $this->logFile();

        Settings::standalone('package')
            ? $this->createPackage()
            : PackagifyService::create($this->request);
        
        // install dependencies
    }

    private function createPackage(): void
    {
        (new SimulateArtisanCall)(
            ['command' => 'create:package', 'name' => null, 'root' => null, 'dev' => false],
            'package'
        );
    }
}
