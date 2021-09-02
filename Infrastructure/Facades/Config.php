<?php

namespace Infrastructure\Facades;

use Infrastructure\Core\Kernel;

final class Config
{
    public static function __callStatic(
        string $methodName,
        array $arguments
    ): mixed {
        return Kernel::getConfig()
            ->$methodName(...$arguments);
    }
}