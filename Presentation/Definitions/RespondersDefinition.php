<?php

namespace Presentation\Definitions;

use Infrastructure\Abstractions\AbstractDefinition;
use Presentation\Interfaces\DashboardResponderInterface;
use Presentation\Interfaces\LoginResponderInterface;
use Presentation\Interfaces\LogoutResponderInterface;
use Presentation\Interfaces\RootResponderInterface;
use Presentation\Responders\DashboardResponder;
use Presentation\Responders\LoginResponder;
use Presentation\Responders\LogoutResponder;
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
            LoginResponderInterface::class => function (ContainerInterface $container) {
                return new LoginResponder();
            },
            LogoutResponderInterface::class => function (ContainerInterface $container) {
                return new LogoutResponder();
            },
            DashboardResponderInterface::class => function (ContainerInterface $container) {
                return new DashboardResponder();
            },
        ];
    }
}
