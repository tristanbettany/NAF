<?php

namespace Infrastructure\Core;

use Dotenv\Dotenv;
use Infrastructure\Database\Connection;
use Infrastructure\Schemas\Container;
use League\Container\Argument\Literal\IntegerArgument;
use League\Container\Argument\Literal\StringArgument;
use League\Container\Argument\LiteralArgument;
use League\Container\Container as LeaugeContainer;
use League\Config\Configuration;
use Infrastructure\Schemas\Database;
use Whoops\Handler\JsonResponseHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use Whoops\Util\Misc;

final class Kernel
{
    private static LeaugeContainer $container;
    private static Configuration $config;

    public static function getConfig(): Configuration
    {
        return static::$config;
    }

    public static function getContainer(): LeaugeContainer
    {
        return static::$container;
    }

    public static function getConnection(): Connection
    {
        return static::$container->get(Connection::class);
    }

    public static function boot(): void
    {
        static::loadEnv();
        static::loadErrorHandler();
        static::loadConfig();
        static::loadContainer();
        static::loadDatabase();
    }

    private static function loadEnv(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
        $dotenv->safeLoad();
    }

    public static function loadErrorHandler(): void
    {
        $errorHandler = new Run();
        $errorHandler->pushHandler(new PrettyPageHandler());
        if (Misc::isAjaxRequest() === true) {
            $errorHandler->pushHandler(new JsonResponseHandler());
        }
        $errorHandler->register();
    }

    private static function loadConfig(): void
    {
        static::$config = new Configuration([
            'database' => Database::define(),
            'container' => Container::define(),
        ]);
        static::$config->merge([
            'database' => Database::values(),
            'container' => Container::values(),
        ]);
    }

    private static function loadContainer(): void
    {
        static::$container = new LeaugeContainer();

        foreach(static::$config->get('container.bindings') as $interface => $concrete) {
            static::$container->add($interface, $concrete);
        }

        foreach(static::$config->get('container.service_providers') as $serviceProvider) {
            static::$container->addServiceProvider(new $serviceProvider());
        }
    }

    private static function loadDatabase(): void
    {
        static::$container->add(Connection::class)->addArguments([
            new StringArgument(
                static::$config->get('database.host')
            ),
            new IntegerArgument(
                static::$config->get('database.port')
            ),
            new StringArgument(
                static::$config->get('database.db_name')
            ),
            new StringArgument(
                static::$config->get('database.username')
            ),
            new LiteralArgument(
                static::$config->get('database.password')
            ),
            new StringArgument(
                static::$config->get('database.charset')
            ),
        ]);
    }
}