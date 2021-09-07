<?php

return [
    'connection' => [
        'host' => env('DB_HOST'),
        'port' => env('DB_PORT'),
        'db_name' => env('DB_NAME'),
        'username' => env('DB_USERNAME'),
        'password' => env('DB_PASSWORD'),
        'charset' => env('DB_CHARSET'),
    ],
    'migrations' => [
        'migrations_paths' => [
            'Database\Migrations' => getcwd() . '/Database/Migrations',
        ],
        'all_or_nothing' => true,
    ],
    'seeds' => [],
];