<?php

use Application\Actions\ExampleAction;

return [
    'sets' => [
        'uri' => '/',
        'action' => ExampleAction::class,
        'middleware' => [],
        'methods' => ['GET'],
    ],
];