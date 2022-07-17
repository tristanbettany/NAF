<?php

namespace Domain\Definitions;

use Domain\Interfaces\RootServiceInterface;
use Domain\Services\RootService;
use Infrastructure\Abstractions\AbstractDefinition;
use Psr\Container\ContainerInterface;

final class RootServiceDefinition extends AbstractDefinition
{
    public function define(): array
    {
        return [
            RootServiceInterface::class => function (ContainerInterface $container) {
                return new RootService();
            },
        ];
    }
}
