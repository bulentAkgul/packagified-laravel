<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Dependenies
    |--------------------------------------------------------------------------
    |
    | When you run the build command, the dependencies in the following list
    | will be downloaded. The keys will come from the values of apps array.
    | Feel free to add new entries based on the settings of apps.
    |
    */
    'blade' => [
        'npm' => [
            'prod' => ['alpinejs', 'livewire'],
            'dev' => [],
        ],
    ],
    'vue' => [
        'npm' => [
            'prod' => ['vue', 'pinia'],
            'dev' => ['vue-loader'],
        ],
    ],
    'inertia' => [
        'npm' => [
            'prod' => ['@inertiajs/inertia', '@inertiajs/inertia-vue3'],
            'dev' => [],
        ],
        'composer' => [
            'prod' => ['inertiajs/inertia-laravel'],
            'dev' => [],
        ],
    ],
];
