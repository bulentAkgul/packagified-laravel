<?php

namespace Bakgul\Packagify\Services\PackagifyServices;

use Bakgul\Kernel\Helpers\Settings;
use Bakgul\Packagify\Functions\MakeFolder;
use Bakgul\Packagify\Tasks\CreateAppRootFiles;
use Bakgul\Packagify\Tasks\CreateAppTypeFiles;

class ClientService
{
    private static $root;

    public static function create()
    {
        if (!class_exists("\Bakgul\ResourceCreator\ResourceCreatorServiceProvider")) return;

        self::$root = MakeFolder::_(base_path('resources'), Settings::folders('apps'));

        foreach (Settings::apps() as $key => $app) {
            $app = [...$app, 'key' => $key];
            
            $path = MakeFolder::_(self::$root, $app['folder']);

            array_map(
                fn ($type) => self::createFiles($app, $path, $type),
                ['css', 'js', 'view']
            );
        }
    }

    private static function createFiles(array $app, string $path, string $type)
    {
        CreateAppRootFiles::_($app, $path, $type);
        CreateAppTypeFiles::_($app, $path, $type);
    }
}
