<?php

namespace Infrastructure\Facades;

use Doctrine\DBAL\Connection as DoctrineConnection;

final class Connection
{
    public static function instance(): DoctrineConnection
    {
        return Container::get(DoctrineConnection::class);
    }

    public static function __callStatic(
        string $methodName,
        array $arguments
    ): mixed {
        return Container::get(DoctrineConnection::class)
            ->$methodName(...$arguments);
    }
}