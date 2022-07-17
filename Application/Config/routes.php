<?php

use Application\Actions\RootAction;
use Application\Actions\LoginAction;
use Application\Actions\LogoutAction;
use Application\Actions\DashboardAction;
use Application\Middleware\FirewallMiddleware;

return [
    'root' => [
        'uri' => '/',
        'action' => RootAction::class,
        'methods' => ['GET'],
    ],
    'login' => [
        'uri' => '/login',
        'action' => LoginAction::class,
        'middleware' => [
            FirewallMiddleware::class
        ],
        'methods' => ['GET', 'POST'],
    ],
    'logout' => [
        'uri' => '/logout',
        'action' => LogoutAction::class,
        'middleware' => [
            FirewallMiddleware::class
        ],
        'methods' => ['GET'],
    ],
    'dashboard' => [
        'uri' => '/dashboard',
        'action' => DashboardAction::class,
        'middleware' => [
            FirewallMiddleware::class
        ],
        'methods' => ['GET'],
    ],
];