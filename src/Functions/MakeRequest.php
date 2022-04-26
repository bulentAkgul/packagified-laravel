<?php

namespace Bakgul\Packagify\Functions;

class MakeRequest
{
    public static function _(array $attr = [], array $map = [])
    {
        return [
            'attr' => [
                'job' => 'packagify',
                'variation' => '',
                'force' => false,
                ...$attr,
            ],
            'map' => [
                ...$map,
            ]
        ];
    }
}
