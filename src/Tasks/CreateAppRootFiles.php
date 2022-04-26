<?php

namespace Bakgul\Packagify\Tasks;

use Bakgul\Kernel\Helpers\Path;
use Bakgul\Kernel\Helpers\Prevented;
use Bakgul\Kernel\Helpers\Settings;
use Bakgul\Packagify\Functions\GetStyleSpecs;
use Bakgul\Packagify\Services\AppTypeServices\BladeViewFilesService;
use Bakgul\Packagify\Services\AppTypeServices\VueScriptFilesService;

class CreateAppRootFiles
{
    public static function _(array $app, string $path, string $type)
    {
        match ($type) {
            'css' => self::cssFiles($app, $path),
            'js' => self::jsFiles($app, $path),
            'view' => self::viewFiles($app, $path),
            default => null
        };
    }

    public static function cssFiles(array $app, string $path)
    {
        if (Prevented::css()) return;

        file_put_contents(Path::glue([$path, "{$app['folder']}." . GetStyleSpecs::_()[1]]), '');
    }

    public static function jsFiles(array $app, string $path)
    {
        $ext = Settings::resources("{$app['type']}.options.ts") ? 'ts' : Settings::resources('js.extension');

        match ($app['type']) {
            'vue' => VueScriptFilesService::root($app, $path, $ext),
            'blade' => file_put_contents(Path::glue([$path, "{$app['folder']}.{$ext}"]), ''),
            default => null
        };
    }

    public static function viewFiles(array $app, string $path)
    {
        if ($app['medium'] == 'browser') BladeViewFilesService::root($app, $path);
    }
}