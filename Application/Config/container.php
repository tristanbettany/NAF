<?php

use Domain\Definitions\DatabaseDefinition;
use Domain\Definitions\RespondersDefinition;
use Domain\Definitions\RootServiceDefinition;

return [
    'definitions' => [
        DatabaseDefinition::class,
        RespondersDefinition::class,
        RootServiceDefinition::class,
    ],
];