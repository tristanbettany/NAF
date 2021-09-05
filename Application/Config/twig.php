<?php

use Twig\Extension\DebugExtension;

return [
    'paths' => [
        'Base' => __DIR__ . '/../../Presentation/Templates/Base',
    ],
    'options' => [
        'debug' => true,
        'cache' => false,
        'strict_variables' => true,
        'auto_reload' => true,
        'autoescape' => 'name',
    ],
    'extensions' => [
        DebugExtension::class,
    ],
];