<?php

use Database\Definitions\DatabaseDefinition;
use Domain\Definitions\RootServiceDefinition;
use Presentation\Definitions\RespondersDefinition;

return [
    'definitions' => [
        DatabaseDefinition::class,
        RespondersDefinition::class,
        RootServiceDefinition::class,
    ],
];