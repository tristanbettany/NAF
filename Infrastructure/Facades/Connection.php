<?php

namespace Infrastructure\Facades;

use Infrastructure\Core\Kernel;

final class Connection
{
    public static function __callStatic(
        string $methodName,
        array $arguments
    ): mixed {
        return Kernel::getConnection()
            ->$methodName(...$arguments);
    }
}