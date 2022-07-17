<?php

namespace Presentation\Definitions;

use Infrastructure\Abstractions\AbstractDefinition;
use Presentation\Interfaces\RootResponderInterface;
use Presentation\Responders\RootResponder;
use Psr\Container\ContainerInterface;

final class RespondersDefinition extends AbstractDefinition
{
    public function define(): array
    {
        return [
            RootResponderInterface::class => function (ContainerInterface $container) {
                return new RootResponder();
            },
        ];
    }
}
