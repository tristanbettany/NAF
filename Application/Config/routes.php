<?php

use Application\Actions\RootAction;
use Application\Middleware\ExampleMiddleware;

return [
    'root' => [
        'uri' => '/',
        'action' => RootAction::class,
        'middleware' => [
            ExampleMiddleware::class
        ],
        'methods' => ['GET'],
    ],
];