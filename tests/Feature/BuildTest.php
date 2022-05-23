<?php

namespace Bakgul\Packagify\Tests\Feature;

use Bakgul\Kernel\Tests\Services\TestDataService;
use Bakgul\Kernel\Tests\Tasks\SetupTest;
use Bakgul\Kernel\Tests\TestCase;

class BuildTest extends TestCase
{
    /** @test */
    public function build_sp()
    {
        (new SetupTest)(TestDataService::standalone('sp'), true);
        
        $this->artisan('build-pl');
    }
    
    /** @test */
    public function build_sl()
    {
        (new SetupTest)(TestDataService::standalone('sl'), true);

        $this->artisan('build-pl');
    }
    
    /** @test */
    public function build_pl()
    {
        (new SetupTest)(TestDataService::standalone('pl'), true);

        $this->artisan('build-pl');
    }
}