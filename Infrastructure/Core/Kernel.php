<?php

namespace Infrastructure\Core;

use Dotenv\Dotenv;
use League\Container\Container;
use League\Config\Configuration;
use Infrastructure\Schemas\DataBaseConnection;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

final class Kernel
{
    private static Container $container;
    private static Configuration $config;

    public static function getConfig(): Configuration
    {
        return static::$config;
    }

    public static function getContainer(): Container
    {
        return static::$container;
    }

    public static function boot(): void
    {
        static::loadErrorHandler();
        static::loadEnv();
        static::loadConfig();
        static::loadContainer();
    }

    public static function loadErrorHandler(): void
    {
        $errorHandler = new Run();
        $errorHandler->pushHandler(new PrettyPageHandler());
        $errorHandler->register();
    }

    private static function loadEnv(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
        $dotenv->safeLoad();
    }

    private static function loadConfig(): void
    {
        static::$config = new Configuration([
            'database' => DataBaseConnection::define(),
        ]);
        static::$config->merge([
            'database' => DataBaseConnection::values(),
        ]);
    }

    private static function loadContainer(): void
    {
        static::$container = new Container();
    }
}