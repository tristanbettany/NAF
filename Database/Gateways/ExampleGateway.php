<?php

namespace Database\Gateways;

use Database\Interfaces\ExampleGatewayInterface;

final class ExampleGateway extends AbstractGateway implements ExampleGatewayInterface
{
    public function getExampleData(): array
    {
        return [
            'id' => 1,
            'name' => 'example',
        ];
    }
}