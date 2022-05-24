<?php

namespace Bakgul\Packagify\Services\PackagifyServices;

use Bakgul\FileContent\Functions\CreateFile;
use Bakgul\Kernel\Helpers\Arry;
use Bakgul\Kernel\Helpers\Path;
use Bakgul\Kernel\Helpers\Prevented;
use Bakgul\Kernel\Helpers\Settings;
use Bakgul\Packagify\Functions\MakeFolder;
use Bakgul\Packagify\Functions\MakeRequest;
use Bakgul\Packagify\Functions\GetStyleSpecs;
use Bakgul\Packagify\Services\AppTypeServices\BladeViewFilesService;

class AppService
{
    private static $root;

    public static function create()
    {
        if (Settings::standalone('package')) return;

        self::$root = MakeFolder::_(base_path('resources'), 'app');

        self::createCssFiles();
        self::createJsFiles();
        self::createViewFiles();
    }

    private static function createCssFiles()
    {
        $container = MakeFolder::_(self::$root, Settings::folders('css'));

        if (Prevented::css()) return;

        MakeFolder::_($container, Settings::folders('components'));
        $container = MakeFolder::_($container, Settings::folders('abstract'));

        [$css, $ext] = GetStyleSpecs::_();

        file_put_contents(Path::glue([$container, "properties.{$ext}"]), ':root {}');

        if ($css != 'sass') return;

        foreach (['variables', 'functions', 'mixins'] as $name) {
            file_put_contents(Path::glue([$container, "{$name}.{$ext}"]), '');
        }
    }

    private static function createJsFiles()
    {
        MakeFolder::_(self::$root, Settings::folders('js'));
    }

    private static function createViewFiles()
    {
        $key = Arry::find(Settings::apps(), 'blade', 'type', nullable: false)['key'];

        BladeViewFilesService::root([
            'key' => $key,
            ...($key ? Settings::apps($key) : []),
            'parent' => '',
            'folder' => 'index',
        ]);
    }
}
