<?php

namespace Bakgul\Packagify\Services;

use Bakgul\Packagify\Functions\MakeFolder;
use Bakgul\Packagify\Services\PackagifyServices\AppService;
use Bakgul\Packagify\Services\PackagifyServices\ClientService;
use Bakgul\Packagify\Services\PackagifyServices\PackageService;

class PackagifyService
{
    public static function create(): void
    {
        MakeFolder::_(base_path('resources'));

        PackageService::create();
        AppService::create();
        ClientService::create();
    }
}