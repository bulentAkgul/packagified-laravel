<?php

namespace Bakgul\Packagify\Services\AppTypeServices;

use Bakgul\Kernel\Helpers\Settings;
use Bakgul\ResourceCreator\Services\ResourceService;

class BladeViewFilesService
{
    public static function create(array $app, string $path)
    {
        //
    }

    public static function root(array $app)
    {
        (new ResourceService)->create(self::request($app));
    }

    private static function request(array $app): array
    {
        return [
            'name' => $app['folder'],
            'type' => 'view',
            'package' => null,
            'app' => $app['key'],
            'parent' => null,
            'class' => false,
            'taskless' => false,
            'variation' => 'root',
            'extra' => '',
            'status' => 'main',
            'subs' => '',
            'queue' => [],
            'signature' => [],
            'pipeline' => Settings::resources('blade'),
            'force' => false,
            'job' => 'packagify',
            'parent' => 'index',
        ];
    }
}




