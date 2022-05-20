<?php

namespace Bakgul\Packagify\Services\PackagifyServices;

use Bakgul\FileContent\Helpers\Content;
use Bakgul\Kernel\Helpers\Arry;
use Bakgul\Kernel\Helpers\Settings;

class ViewService
{
    private static $path;
    private static $content;
    private static $lines;

    public static function register()
    {
        self::setPath();

        if (self::isNotRegisterable()) return;

        self::getContent();

        self::makeLines();

        self::injectLines();

        self::writeContent();
    }

    private static function setPath()
    {
        self::$path = base_path('config/view.php');
    }

    private static function isNotRegisterable()
    {
        return Settings::standalone('package')
            || !file_exists(self::$path);
    }

    private static function makeLines()
    {
        $lines = ["resource_path('" . self::makePath('app') . "'),"];

        foreach (Settings::apps(callback: fn ($x) => $x['type'] == 'blade') as $app) {
            $lines[] = implode('', [
                "resource_path('",
                self::makePath(appFolder: $app['folder']),
                "'),"
            ]);
        }

        self::setLines($lines);
    }

    private static function makePath($root = '', $appFolder = '')
    {
        return implode('/', array_filter([
            $root ?: Settings::folders('apps'),
            $appFolder,
            Settings::folders('views'),
        ]));
    }

    private static function setLines($lines)
    {
        self::$lines = implode(PHP_EOL, array_map(fn ($x) =>  str_repeat(' ', 8) . $x, $lines));
    }

    private static function getContent()
    {
        self::$content = file(self::$path);
    }

    private static function injectLines()
    {
        array_splice(self::$content, self::injectTo(), 0, self::$lines);
    }

    private static function injectTo()
    {
        return Arry::containsAt("'paths' => [", self::$content) + 1;
    }

    private static function writeContent()
    {
        Content::write(self::$path, self::$content, '');
    }
}
