<?php

namespace Bakgul\Packagify\Tasks;

use Bakgul\Kernel\Helpers\Settings;
use Bakgul\Packagify\Functions\MakeFolder;
use Bakgul\Packagify\Services\AppTypeServices\VueScriptFilesService;

class CreateAppTypeFiles
{
    public static function _(array $app, string $path, string $type)
    {
        $path = MakeFolder::_($path, Settings::folders($type));
        ray($app, $type);
        match (true) {
            $app['type'] == 'vue' && $type == 'js' => VueScriptFilesService::create($app, $path),
            default => null,
        };
    }
}