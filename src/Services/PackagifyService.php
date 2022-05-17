<?php

namespace Bakgul\Packagify\Services;

use Bakgul\Kernel\Helpers\Folder;
use Bakgul\Kernel\Helpers\Settings;
use Bakgul\Packagify\Functions\MakeFolder;
use Bakgul\Packagify\Services\PackagifyServices\AppService;
use Bakgul\Packagify\Services\PackagifyServices\ClientService;

class PackagifyService
{
    public static function create(): void
    {        
        self::resources();
        self::packages();

        AppService::create();
        ClientService::create();
    }

    private static function resources()
    {
        file_exists(base_path('resources'))
            ? array_map(fn ($x) => unlink($x), Folder::files(base_path('resources')))
            : MakeFolder::_(base_path('resources'));
    }

    private static function packages()
    {
        if (Settings::standalone()) return;

        foreach (Settings::roots() as $root) {
            MakeFolder::_(base_path(Settings::folders('packages')), $root['folder']);
        }
    }
}