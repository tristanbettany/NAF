<?php

namespace Domain\Definitions;

use Database\Interfaces\ExampleGatewayInterface;
use Domain\Interfaces\ExampleServiceInterface;
use Domain\Services\ExampleService;
use Psr\Container\ContainerInterface;

final class ExampleServiceDefinition extends AbstractDefinition
{
    public function define(): array
    {
        return [
            ExampleServiceInterface::class => function (ContainerInterface $container) {
                return new ExampleService($container->get(ExampleGatewayInterface::class));
            },
        ];
    }
}
