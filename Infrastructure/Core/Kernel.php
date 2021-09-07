<?php

namespace Infrastructure\Core;

use Doctrine\DBAL\DriverManager;
use Doctrine\Migrations\Configuration\Connection\ExistingConnection;
use Doctrine\Migrations\Configuration\Migration\ConfigurationArray;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Tools\Console\Command\DumpSchemaCommand;
use Doctrine\Migrations\Tools\Console\Command\ExecuteCommand;
use Doctrine\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\Migrations\Tools\Console\Command\LatestCommand;
use Doctrine\Migrations\Tools\Console\Command\ListCommand;
use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\Migrations\Tools\Console\Command\RollupCommand;
use Doctrine\Migrations\Tools\Console\Command\StatusCommand;
use Doctrine\Migrations\Tools\Console\Command\SyncMetadataCommand;
use Doctrine\Migrations\Tools\Console\Command\VersionCommand;
use Dotenv\Dotenv;
use Infrastructure\Interfaces\ConnectionInterface;
use Infrastructure\Schemas\Commands;
use Infrastructure\Schemas\Container;
use Infrastructure\Schemas\Routes;
use Infrastructure\Schemas\Twig;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Container\Argument\Literal\IntegerArgument;
use League\Container\Argument\Literal\StringArgument;
use League\Container\Argument\LiteralArgument;
use League\Container\Container as LeaugeContainer;
use League\Config\Configuration;
use Infrastructure\Schemas\Database;
use League\Route\Router;
use League\Route\Strategy\ApplicationStrategy;
use League\Route\Strategy\StrategyAwareInterface;
use Symfony\Component\Console\Application;
use Whoops\Handler\JsonResponseHandler;
use Whoops\Handler\PlainTextHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use Whoops\Util\Misc;

final class Kernel
{
    private static LeaugeContainer $container;
    private static Configuration $config;
    private static StrategyAwareInterface $router;

    public static function getConfig(): Configuration
    {
        return static::$config;
    }

    public static function getContainer(): LeaugeContainer
    {
        return static::$container;
    }

    public static function getConnection(): ConnectionInterface
    {
        return static::$container->get(Connection::class);
    }

    public static function boot(): void
    {
        static::loadEnv();
        static::loadErrorHandler();
        static::loadConfig();
        static::loadContainer();
        static::loadRouting();
        static::loadDatabase();
        static::dispatch();
    }

    public static function bootCli(): void
    {
        static::loadEnv();
        static::loadErrorHandler();
        static::loadConfig();
        static::loadContainer();
        static::loadDatabase();
        static::cli();
    }

    public static function loadEnv(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
        $dotenv->safeLoad();
    }

    public static function loadErrorHandler(): void
    {
        $errorHandler = new Run();
        if (Misc::isCommandLine() === false) {
            $errorHandler->pushHandler(new PrettyPageHandler());

            if (Misc::isAjaxRequest() === true) {
                $errorHandler->pushHandler(new JsonResponseHandler());
            }
        } else {
            $errorHandler->pushHandler(new PlainTextHandler());
        }

        $errorHandler->register();
    }

    public static function loadConfig(): void
    {
        static::$config = new Configuration([
            'database' => Database::define(),
            'container' => Container::define(),
            'routes' => Routes::define(),
            'twig' => Twig::define(),
            'commands' => Commands::define(),
        ]);
        static::$config->merge([
            'database' => Database::values(),
            'container' => Container::values(),
            'routes' => Routes::values(),
            'twig' => Twig::values(),
            'commands' => Commands::values(),
        ]);
    }

    public static function loadContainer(): void
    {
        static::$container = new LeaugeContainer();

        foreach(static::$config->get('container.service_providers') as $serviceProvider) {
            static::$container->addServiceProvider(new $serviceProvider());
        }

        foreach(static::$config->get('container.actions') as $action => $arguments) {
            static::$container->add($action)
                ->addArguments($arguments);
        }
    }

    public static function loadRouting(): void
    {
        $strategy = (new ApplicationStrategy)->setContainer(static::$container);
        static::$router = (new Router())->setStrategy($strategy);

        foreach (static::$config->get('routes') as $route) {
            foreach ($route['methods'] as $method) {
                $middlewares = [];
                foreach ($route['middleware'] as $middleware) {
                    $middlewares[] = new $middleware;
                }

                static::$router->map(
                    $method,
                    $route['uri'],
                    $route['action']
                )->middlewares($middlewares);
            }
        }
    }

    public static function loadDatabase(): void
    {
        static::$container->add(ConnectionInterface::class, Connection::class)->addArguments([
            new StringArgument(
                static::$config->get('database.connection.host')
            ),
            new IntegerArgument(
                static::$config->get('database.connection.port')
            ),
            new StringArgument(
                static::$config->get('database.connection.db_name')
            ),
            new StringArgument(
                static::$config->get('database.connection.username')
            ),
            new LiteralArgument(
                static::$config->get('database.connection.password')
            ),
            new StringArgument(
                static::$config->get('database.connection.charset')
            ),
        ]);
    }

    public static function dispatch(): void
    {
        $request = ServerRequestFactory::fromGlobals(
            $_SERVER,
            $_GET,
            $_POST,
            $_COOKIE,
            $_FILES
        );

        $response = static::$router->dispatch($request);

        (new SapiEmitter())->emit($response);
    }

    public static function cli() :void
    {
        $application = new Application();
        foreach(static::$config->get('commands') as $command) {
            $application->add(new $command);
        }

        /**
         * Setup Doctrine migrations commands
         */
        $connection = DriverManager::getConnection(
            [
                'dbname' => static::$config->get('database.connection.db_name'),
                'user' => static::$config->get('database.connection.username'),
                'password' => static::$config->get('database.connection.password'),
                'host' => static::$config->get('database.connection.host'),
                'driver' => 'pdo_mysql',
                'memory' => true,
            ]
        );

        $dependencyFactory = DependencyFactory::fromConnection(
            new ConfigurationArray(static::$config->get('database.migrations')),
            new ExistingConnection($connection)
        );

        $application->addCommands([
            new DumpSchemaCommand($dependencyFactory),
            new ExecuteCommand($dependencyFactory),
            new GenerateCommand($dependencyFactory),
            new LatestCommand($dependencyFactory),
            new ListCommand($dependencyFactory),
            new MigrateCommand($dependencyFactory),
            new RollupCommand($dependencyFactory),
            new StatusCommand($dependencyFactory),
            new SyncMetadataCommand($dependencyFactory),
            new VersionCommand($dependencyFactory),
        ]);

        $application->run();
    }
}