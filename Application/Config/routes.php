<?php

use Application\Actions\SetsAction;

return [
    'sets' => [
        'uri' => '/sets',
        'action' => SetsAction::class,
        'middleware' => [],
        'methods' => ['GET'],
    ],
];