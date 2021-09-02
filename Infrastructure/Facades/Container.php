<?php

namespace Infrastructure\Facades;

use Infrastructure\Core\Kernel;

final class Container
{
    public static function __callStatic(
        string $methodName,
        array $arguments
    ): mixed {
        return Kernel::getContainer()
            ->$methodName(...$arguments);
    }
}