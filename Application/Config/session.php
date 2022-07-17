<?php

use Laminas\Session\Validator\RemoteAddr;
use Laminas\Session\Validator\HttpUserAgent;

return [
    'validators' => [
        RemoteAddr::class,
        HttpUserAgent::class,
    ],
];