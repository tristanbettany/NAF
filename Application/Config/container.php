<?php

use Domain\ServiceProviders\AppServiceProvider;
use Domain\ServiceProviders\SetServiceProvider;

return [
    'service_providers' => [
        AppServiceProvider::class,
        SetServiceProvider::class
    ],
];