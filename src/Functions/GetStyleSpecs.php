<?php

namespace Bakgul\Packagify\Functions;

use Bakgul\Kernel\Helpers\Settings;

class GetStyleSpecs
{
    public static function _()
    {
        $css = Settings::main('css');
        $ext = Settings::resources("{$css}.extension");

        return [$css, $ext];
    }
}