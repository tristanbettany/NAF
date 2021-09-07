<?php

namespace Domain\ServiceProviders;

use Database\Gateways\ExampleGateway;
use Database\Interfaces\ExampleGatewayInterface;
use Domain\Interfaces\ExampleServiceInterface;
use Domain\Services\ExampleService;
use Infrastructure\Interfaces\ConnectionInterface;
use League\Container\ServiceProvider\AbstractServiceProvider;

final class ExampleServiceProvider extends AbstractServiceProvider
{
    public function provides(string $id): bool
    {
        $services = [
            ExampleServiceInterface::class,
        ];

        return in_array($id, $services);
    }

    public function register(): void
    {
        $container = $this->getContainer();

        $container->add(ExampleGatewayInterface::class, ExampleGateway::class)
            ->addArgument(ConnectionInterface::class);

        $container->add(ExampleServiceInterface::class, ExampleService::class)
            ->addArgument(ExampleGatewayInterface::class);
    }
}