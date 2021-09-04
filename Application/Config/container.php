<?php

use Domain\ServiceProviders\AppServiceProvider;
use Domain\ServiceProviders\SetServiceProvider;
use Application\Actions\SetsAction;
use Domain\Interfaces\SetServiceInterface;

return [
    'actions' => [
        SetsAction::class => [
            SetServiceInterface::class,
        ],
    ],
    'service_providers' => [
        AppServiceProvider::class,
        SetServiceProvider::class
    ],
];