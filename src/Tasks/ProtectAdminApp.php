<?php

namespace Bakgul\Packagify\Tasks;

use Bakgul\FileContent\Tasks\Register;
use Bakgul\Kernel\Functions\CreateFileRequest;
use Bakgul\Kernel\Helpers\Arry;
use Bakgul\Kernel\Helpers\Path;
use Bakgul\Kernel\Helpers\Settings;
use Bakgul\Kernel\Helpers\Text;
use Bakgul\Kernel\Tasks\ConvertCase;
use Bakgul\Kernel\Tasks\SimulateArtisanCall;

class ProtectAdminApp
{
    const MIDDLEWARE = 'ensure-user-can-use-admin-app';

    public static function _()
    {
        if (self::noAdminApp()) return;

        Settings::set('evaluator.evaluate_commands', false);
        
        self::createMiddleware();

       self::registerMiddleware();

        Settings::set('evaluator.evaluate_commands', true);

    }

    private static function createMiddleware()
    {
        (new SimulateArtisanCall)(CreateFileRequest::_([
            'name' => self::MIDDLEWARE,
            'type' => 'middleware',
        ]));
    }

    private static function registerMiddleware()
    {
        Register::_(self::request(), [], self::blockSpecs(), 'block', 'block');
    }

    private static function request()
    {
        return [
            'attr' => [
                'target_file' => Path::glue([Path::head(family: 'src'), 'Http', 'Kernel.php'])
            ],
            'map' => [
                'imports' => '',
                'block' => Text::wrap('admin', 'sq') . ' => ' . self::namespace()]
        ];
    }

    private static function blockSpecs()
    {
        return [
            'start' => ['protected $routeMiddleware = [', 0],
            'end' => [']', 0],
            'repeat' => 1,
            'isSortable' => true,
            'bracket' => '[]'
        ];
    }

    private static function namespace()
    {
        return '\App\Http\Middleware\\' . ConvertCase::pascal(self::MIDDLEWARE) .  '::class';
    }

    private static function noAdminApp()
    {
        return Arry::hasNot('admin', Settings::apps());
    }
}
