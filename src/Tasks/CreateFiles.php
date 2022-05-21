<?php

namespace Bakgul\Packagify\Tasks;

use Bakgul\Packagify\Services\AppTypeServices\BladeViewFilesService;
use Bakgul\Packagify\Services\AppTypeServices\StyleFilesService;
use Bakgul\Packagify\Services\AppTypeServices\VanillaJsFilesService;
use Bakgul\Packagify\Services\AppTypeServices\VueScriptFilesService;
use Bakgul\Packagify\Services\AppTypeServices\VueViewFilesService;

class CreateFiles
{
    public static function _(array $app, string $type)
    {
        match ($type) {
            'view' => self::viewFiles($app),
            'css' => self::cssFiles($app),
            'js' => self::jsFiles($app),
            default => null
        };
    }

    public static function cssFiles(array $app)
    {
        StyleFilesService::root($app);
    }

    public static function jsFiles(array $app)
    {
        match ($app['type']) {
            'vue' => VueScriptFilesService::root($app),
            'blade' => VanillaJsFilesService::root($app),
            default => null
        };
    }

    public static function viewFiles(array $app)
    {
        if ($app['medium'] == 'browser') BladeViewFilesService::root($app);

        match($app['type']) {
            'vue' => VueViewFilesService::root($app),
            default => null
        };
    }
}