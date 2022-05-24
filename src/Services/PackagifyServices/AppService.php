<?php

namespace Bakgul\Packagify\Services\PackagifyServices;

use Bakgul\FileContent\Functions\CreateFile;
use Bakgul\Kernel\Helpers\Arry;
use Bakgul\Kernel\Helpers\Path;
use Bakgul\Kernel\Helpers\Prevented;
use Bakgul\Kernel\Helpers\Settings;
use Bakgul\Kernel\Helpers\Text;
use Bakgul\Packagify\Functions\MakeFolder;
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
        if (Prevented::css()) return;

        $container = MakeFolder::_(self::$root, Settings::folders('css'));

        $ext = Settings::resources(Settings::main('css') . '.extension');

        foreach (Settings::structures('resources.' . Settings::main('css')) as $folder => $files) {
            $path = MakeFolder::_(Path::glue([$container, $folder]));

            foreach ($files as $file) {
                CreateFile::_(self::request($path, "{$file}.{$ext}"));

                if ($file == '_index') self::forwardFiles($path, "{$file}.{$ext}", $files);
            }
        }
    }

    private static function request($path, $file)
    {
        return [
            'attr' => ['path' => $path, 'file' => $file, 'stub' => 'css.stub', 'force' => false, 'job' => 'packagify', 'variation' => ''],
            'map' => []
        ];
    }

    private static function forwardFiles($path, $index, $files)
    {
        file_put_contents(
            Path::glue([$path, $index]),
            implode(PHP_EOL, array_map(
                fn ($x) => '@forward ' . Text::wrap("./{$x}", 'dq') . ';',
                Arry::sort(array_filter($files, fn ($x) => $x != '_index'))
            ))
        );
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
