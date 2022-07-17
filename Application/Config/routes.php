<?php

use Application\Actions\RootAction;
use Application\Middleware\AuthMiddleware;

return [
    'root' => [
        'uri' => '/',
        'action' => RootAction::class,
        'methods' => ['GET'],
    ],
    'login' => [
        'uri' => '/login',
        'action' => RootAction::class,
        'methods' => ['GET'],
    ],
    'logout' => [
        'uri' => '/logout',
        'action' => RootAction::class,
        'middleware' => [
            AuthMiddleware::class
        ],
        'methods' => ['GET'],
    ],
    'dashboard' => [
        'uri' => '/dashboard',
        'action' => RootAction::class,
        'middleware' => [
            AuthMiddleware::class
        ],
        'methods' => ['GET'],
    ],
];