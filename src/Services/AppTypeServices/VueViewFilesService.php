<?php

namespace Bakgul\Packagify\Services\AppTypeServices;

use Bakgul\Kernel\Helpers\Settings;
use Bakgul\ResourceCreator\Services\ResourceService;

class VueViewFilesService
{
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
            'variation' => 'layout',
            'extra' => '',
            'status' => 'main',
            'subs' => '',
            'wrapper' => null,
            'queue' => [],
            'signature' => [],
            'pipeline' => ['type' => 'vue', ...Settings::resources('vue')],
            'force' => false
        ];
    }
}




