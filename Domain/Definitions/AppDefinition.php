<?php

namespace Domain\Definitions;

use Domain\Helpers\Session;
use Domain\Interfaces\SessionInterface;
use Infrastructure\Abstractions\AbstractDefinition;
use Psr\Container\ContainerInterface;

final class AppDefinition extends AbstractDefinition
{
    public function define(): array
    {
        return [
            SessionInterface::class => function (ContainerInterface $container) {
                return new Session();
            },
        ];
    }
}
