<?php

namespace Bakgul\Packagify\Services\AppTypeServices;

use Bakgul\Kernel\Helpers\Settings;
use Bakgul\ResourceCreator\Services\ResourceService;

class VueViewFilesService
{
    public static function create(array $app, string $path)
    {
        (new ResourceService)->create(self::request($app, $path));
    }

    private static function request(array $app, string $path): array
    {
        return [
            'name' => 'app',
            'type' => 'view',
            'package' => null,
            'app' => $app['key'],
            'parent' => null,
            'class' => false,
            'taskless' => false,
            'variation' => 'layout',
            'extra' => '',
            'status' => 'main',
            'subs' => '',
            'wrapper' => null,
            'queue' => [],
            'signature' => [],
            'pipeline' => Settings::resources('vue'),
            'force' => false
        ];
    }
}




