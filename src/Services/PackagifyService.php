<?php

namespace Bakgul\Packagify\Services;

use Bakgul\Kernel\Helpers\Folder;
use Bakgul\Kernel\Helpers\Path;
use Bakgul\Kernel\Helpers\Settings;
use Bakgul\Kernel\Helpers\Text;
use Bakgul\Kernel\Tasks\CompleteFolders;
use Bakgul\Packagify\Functions\MakeFolder;
use Bakgul\Packagify\Services\PackagifyServices\AppService;
use Bakgul\Packagify\Services\PackagifyServices\ClientService;

class PackagifyService
{
    public static function create(): void
    {
        self::logFolders();
        self::resources();
        self::packages();
        self::copy();

        AppService::create();
        ClientService::create();
    }

    private static function logFolders()
    {
        $base = Path::glue([storage_path(), 'logs', 'packagify', '']);

        array_map(fn ($x) => CompleteFolders::_("{$base}{$x}"), ['redo', 'undo']);
    }

    private static function resources()
    {
        file_exists(base_path('resources'))
            ? Folder::refresh(base_path('resources'))
            : MakeFolder::_(base_path('resources'));
    }

    private static function packages()
    {
        if (Settings::standalone('laravel')) return;

        foreach (Settings::roots() as $root) {
            MakeFolder::_(base_path(Settings::folders('packages')), $root['folder']);
        }
    }

    private static function copy()
    {
        if (Settings::standalone('laravel')) return;

        $files = Folder::files(Path::glue([__DIR__, '..', '..', 'files']));

        foreach ($files as $file) {
            $paste = base_path(str_replace('.stub', '', explode('files' . DIRECTORY_SEPARATOR, $file)[1]));

            CompleteFolders::_(Text::dropTail($paste));

            copy($file, $paste);
        }
    }
}
