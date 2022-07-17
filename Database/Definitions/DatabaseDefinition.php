<?php

namespace Database\Definitions;

use Database\Interfaces\UserRepositoryInterface;
use Database\Repositories\UserRepository;
use Doctrine\DBAL\Connection as DoctrineConnection;
use Doctrine\DBAL\DriverManager;
use Infrastructure\Abstractions\AbstractDefinition;
use Infrastructure\Facades\Config;
use Infrastructure\Facades\Connection;
use Psr\Container\ContainerInterface;

final class DatabaseDefinition extends AbstractDefinition
{
    public function define(): array
    {
        return [
            DoctrineConnection::class => function (ContainerInterface $container) {
                return DriverManager::getConnection(
                    [
                        'dbname' => Config::get('database.connection.db_name'),
                        'user' => Config::get('database.connection.username'),
                        'password' => Config::get('database.connection.password'),
                        'host' => Config::get('database.connection.host'),
                        'driver' => 'pdo_mysql',
                        'memory' => true,
                    ]
                );
            },
            UserRepositoryInterface::class => function (ContainerInterface $container) {
                return new UserRepository(Connection::instance());
            },
        ];
    }
}
