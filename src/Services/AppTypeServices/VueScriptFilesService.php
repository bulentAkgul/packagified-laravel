<?php

namespace Bakgul\Packagify\Services\AppTypeServices;

use Bakgul\Kernel\Functions\CreateFile;
use Bakgul\Kernel\Helpers\Path;
use Bakgul\Kernel\Helpers\Settings;
use Bakgul\Packagify\Functions\MakeRequest;
use Bakgul\ResourceCreator\Services\ResourceService;

class VueScriptFilesService
{
    public static function root(array $app, string $path, string $ext)
    {
        (new ResourceService)->create(self::request($app));
    }

    private static function request(array $app): array
    {
        return [
            'name' => $app['folder'],
            'type' => 'js',
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
            'pipeline' => ['type' => 'vue', ...Settings::resources('vue')],
            'force' => false,
            'job' => 'packagify',
            'parent' => '',
        ];
    }

    public static function create(array $app, string $path)
    {
        $ext = Settings::resources("{$app['type']}.options.ts") ? 'ts' : Settings::resources('js.extension') ?? 'js';

        self::makeRouter($app, $path, $ext);

        self::makeStore($path, $ext);
    }

    private static function makeRouter(array $app, string $path, string $ext)
    {
        ray($app);
        if ($app['router'] != 'vue-router') return;

        CreateFile::_(MakeRequest::_(
            [
                'path' => self::setPath($path),
                'file' => "router.{$ext}",
                'stub' => 'js.vue.router.stub',
            ],
            [
                'container' => Settings::folders('view'),
                'route_group' => $app['route_group']
            ]
        ));
    }

    private static function makeStore(string $path, string $ext)
    {
        if (Settings::resources('vue.options.store') != 'vuex') return;

        CreateFile::_(MakeRequest::_([
            'path' => self::setPath($path),
            'file' => "stores.{$ext}",
            'stub' => 'js.vue.stores.stub',
        ]));
    }
    
    private static function setPath(string $path)
    {
        return Path::glue([$path, Settings::folders('js')]);
    }
}
