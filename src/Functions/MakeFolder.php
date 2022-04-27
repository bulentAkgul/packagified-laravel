<?php

namespace Bakgul\Packagify\Functions;

use Bakgul\Kernel\Tasks\CompleteFolders;
use Bakgul\Kernel\Helpers\Path;

class MakeFolder
{
    public static function _(string $root, string $container = ''): string
    {
        $folder = Path::glue(array_filter([$root, $container]));
        
        CompleteFolders::_($folder);

        return $folder;
    }
}