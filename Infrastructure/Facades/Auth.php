<?php

namespace Infrastructure\Facades;

use Domain\Interfaces\AuthServiceInterface;

final class Auth
{
    public static function __callStatic(
        string $methodName,
        array $arguments
    ): mixed {
        return Container::get(AuthServiceInterface::class)
            ->$methodName(...$arguments);
    }
}