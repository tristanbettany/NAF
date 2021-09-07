<?php

use Domain\ServiceProviders\AppServiceProvider;
use Domain\ServiceProviders\ExampleServiceProvider;
use Application\Actions\ExampleAction;
use Domain\Interfaces\ExampleServiceInterface;

return [
    'actions' => [
        ExampleAction::class => [
            ExampleServiceInterface::class,
        ],
    ],
    'service_providers' => [
        AppServiceProvider::class,
        ExampleServiceProvider::class
    ],
];