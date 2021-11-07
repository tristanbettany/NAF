<?php

namespace Infrastructure\Facades;

use Infrastructure\Core\Kernel;
use Psr\Container\ContainerInterface;

final class Container
{
    public static function instance(): ContainerInterface
    {
        return Kernel::getContainer();
    }

    public static function __callStatic(
        string $methodName,
        array $arguments
    ): mixed {
        return Kernel::getContainer()
            ->$methodName(...$arguments);
    }
}