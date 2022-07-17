<?php

namespace Infrastructure\Facades;

use Domain\Interfaces\SessionInterface;

final class Session
{
    public static function instance(): SessionInterface
    {
        return Container::get(SessionInterface::class);
    }

    public static function __callStatic(
        string $methodName,
        array $arguments
    ): mixed {
        return Container::get(SessionInterface::class)
            ->$methodName(...$arguments);
    }
}