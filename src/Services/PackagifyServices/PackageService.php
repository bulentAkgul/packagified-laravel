<?php

namespace Bakgul\Packagify\Services\PackagifyServices;

use Bakgul\Kernel\Helpers\Settings;
use Bakgul\Packagify\Functions\MakeFolder;

class PackageService
{
    public static function create()
    {
        if (Settings::standalone()) return;
        
        foreach (Settings::roots() as $root) {
            MakeFolder::_(base_path('resources'), $root['folder']);
        }
    }
}
