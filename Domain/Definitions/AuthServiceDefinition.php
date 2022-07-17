<?php

namespace Domain\Definitions;

use Database\Interfaces\UserRepositoryInterface;
use Domain\Interfaces\AuthServiceInterface;
use Domain\Interfaces\SessionInterface;
use Domain\Services\AuthService;
use Infrastructure\Abstractions\AbstractDefinition;
use Psr\Container\ContainerInterface;

final class AuthServiceDefinition extends AbstractDefinition
{
    public function define(): array
    {
        return [
            AuthServiceInterface::class => function (ContainerInterface $container) {
                return new AuthService(
                    $container->get(SessionInterface::class),
                    $container->get(UserRepositoryInterface::class)
                );
            },
        ];
    }
}
