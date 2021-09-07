<?php

namespace Domain\Services;

use Database\Interfaces\ExampleGatewayInterface;
use Domain\Interfaces\ExampleServiceInterface;

final class ExampleService implements ExampleServiceInterface
{
    public function __construct(
        private ExampleGatewayInterface $exampleGateway
    ){
    }

    public function getExampleData(): array
    {
        return $this->exampleGateway->getExampleData();
    }
}