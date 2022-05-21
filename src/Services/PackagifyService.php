<?php

namespace Bakgul\Packagify\Services;

use Bakgul\Packagify\Services\PackagifyServices\AppService;
use Bakgul\Packagify\Services\PackagifyServices\ClientService;
use Bakgul\Packagify\Services\PackagifyServices\ViewService;
use Bakgul\Packagify\Tasks\Prepare;

class PackagifyService
{
    public static function create(): void
    {
        Prepare::_();
        AppService::create();
        ClientService::create();
        ViewService::register();
    }
}
