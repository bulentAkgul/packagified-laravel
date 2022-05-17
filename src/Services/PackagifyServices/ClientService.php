<?php

namespace Bakgul\Packagify\Services\PackagifyServices;

use Bakgul\Kernel\Helpers\Settings;
use Bakgul\Packagify\Functions\MakeFolder;
use Bakgul\Packagify\Tasks\CreateFiles;

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
                fn ($type) => CreateFiles::_($app, $path, $type),
                ['css', 'js', 'view']
            );
        }
    }
}
