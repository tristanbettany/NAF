<?php

namespace Infrastructure\Core;

use Dotenv\Dotenv;
use Infrastructure\Schemas\Container;
use League\Container\Container as LeaugeContainer;
use League\Config\Configuration;
use Infrastructure\Schemas\DataBaseConnection;
use phpDocumentor\Reflection\Types\Static_;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

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
            'container' => Container::define(),
        ]);
        static::$config->merge([
            'database' => DataBaseConnection::values(),
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
}