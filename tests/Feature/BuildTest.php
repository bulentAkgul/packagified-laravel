<?php

namespace Bakgul\Packagify\Tests\Feature;

use Bakgul\Kernel\Tests\Services\TestDataService;
use Bakgul\Kernel\Tests\Tasks\SetupTest;
use Bakgul\Kernel\Tests\TestCase;

class BuildTest extends TestCase
{
    /** @test */
    public function create_sp()
    {
        (new SetupTest)(TestDataService::standalone('sp'), true);

        $this->artisan('build-pl');
    }

    /** @test */
    public function create_sl()
    {
        (new SetupTest)(TestDataService::standalone('sl'), true);

        $this->artisan('build-pl');
    }
    
    /** @test */
    public function create_pl()
    {
        (new SetupTest)(TestDataService::standalone('pl'), true);

        $this->artisan('build-pl');
    }
}