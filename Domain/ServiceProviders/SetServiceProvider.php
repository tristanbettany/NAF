<?php

namespace Domain\ServiceProviders;

use Database\Gateways\SetGateway;
use Database\Interfaces\SetGatewayInterface;
use Domain\Interfaces\SetServiceInterface;
use Domain\Services\SetService;
use Infrastructure\Interfaces\ConnectionInterface;
use League\Container\ServiceProvider\AbstractServiceProvider;

final class SetServiceProvider extends AbstractServiceProvider
{
    public function provides(string $id): bool
    {
        $services = [
            SetServiceInterface::class,
        ];

        return in_array($id, $services);
    }

    public function register(): void
    {
        $container = $this->getContainer();

        $container->add(SetGatewayInterface::class, SetGateway::class)
            ->addArgument(ConnectionInterface::class);

        $container->add(SetServiceInterface::class, SetService::class)
            ->addArgument(SetGatewayInterface::class);
    }
}