<?php

namespace Bakgul\Packagify\Services\PackagifyServices;

use Bakgul\Kernel\Helpers\Path;
use Bakgul\Kernel\Helpers\Settings;
use Bakgul\Kernel\Helpers\Text;

class RootService
{
    public static function create()
    {
        self::webpack();
    }

    private static function webpack()
    {
        $content = ["const mix = require('laravel-mix');", "", "mix", "  .disableNotifications()"];

        $apps = Settings::apps();

        file_put_contents(base_path('webpack.mix.js'), implode(PHP_EOL, array_merge($content, self::mixStyles($apps), self::mixScripts($apps))));
    }

    private static function mixStyles($apps)
    {
        $container = Settings::folders('apps');
        $folder = Settings::folders('css');
        $style = Settings::main('css');
        $ext = Settings::resources("{$style}.extension");

        $styles = [];

        foreach ($apps as $app) {
            $from = ['resources', $container, $app['folder'], $folder, "{$app['folder']}.{$ext}"];

            if (!file_exists(base_path(Path::glue($from)))) continue;

            $styles[] = "  .{$style}(" . Text::wrap(Path::glue($from, '/'), 'dq') . ', "public/css/' . $app['folder'] . '.css")';
        }

        return $styles;
    }

    private static function mixScripts($apps)
    {
        $container = Settings::folders('apps');
        $folder = Settings::folders('js');

        $scripts = [];

        foreach ($apps as $app) {
            $ext = Settings::resources("js.extension");
            $method = $app['type'] == 'react' ? 'react' : $ext;

            $from = ['resources', $container, $app['folder'], $folder, "{$app['folder']}.{$ext}"];

            if (!file_exists(base_path(Path::glue($from)))) continue;

            $scripts[] = implode('', [
                "  .{$method}(",
                Text::wrap(Path::glue($from, '/'), 'dq'),
                ', "public/js/',
                "{$app['folder']}.js",
                '")',
                $app['type'] != 'blade' ? '.extract()' : ''
            ]);
        }

        return $scripts;
    }
}