<?php

use Application\Actions\ExampleAction;
use Application\Middleware\ExampleMiddleware;

return [
    'sets' => [
        'uri' => '/',
        'action' => ExampleAction::class,
        'middleware' => [
            ExampleMiddleware::class
        ],
        'methods' => ['GET'],
    ],
];