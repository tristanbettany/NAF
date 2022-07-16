<?php

namespace Infrastructure\Core;

use Application\ExceptionHandlers\SentryExceptionHandler;
use DI\ContainerBuilder;
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
use Domain\Interfaces\DefinitionInterface;
use Dotenv\Dotenv;
use Infrastructure\Facades\Connection;
use Infrastructure\Schemas\Commands;
use Infrastructure\Schemas\Container;
use Infrastructure\Schemas\Routes;
use Infrastructure\Schemas\Twig;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Config\Configuration;
use Infrastructure\Schemas\Database;
use League\Route\Router;
use League\Route\Strategy\ApplicationStrategy;
use League\Route\Strategy\StrategyAwareInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Whoops\Handler\JsonResponseHandler;
use Whoops\Handler\PlainTextHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use Whoops\Util\Misc;
use function Sentry\init;

final class Kernel
{
    private static ContainerInterface $container;
    private static Configuration $config;
    private static StrategyAwareInterface $router;

    public static function getConfig(): Configuration
    {
        return static::$config;
    }

    public static function getContainer(): ContainerInterface
    {
        if (empty(static::$container) === true) {
            static::boot();
        }

        return static::$container;
    }

    public static function boot(): void
    {
        if (empty(static::$container) === true) {
            static::loadEnv();
            static::loadErrorHandler();
            static::loadConfig();
            static::loadContainer();
        }
    }

    public static function loadEnv(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
        $dotenv->safeLoad();
    }

    public static function loadErrorHandler(): void
    {
        init([
            'dsn' => env('SENTRY_DSN'),
            'default_integrations' => false,
        ]);

        $errorHandler = new Run();
        if (Misc::isCommandLine() === false) {
            $errorHandler->pushHandler(new PrettyPageHandler());

            if (Misc::isAjaxRequest() === true) {
                $errorHandler->pushHandler(new JsonResponseHandler());
            }
        } else {
            $errorHandler->pushHandler(new PlainTextHandler());
        }

        $errorHandler->pushHandler(new SentryExceptionHandler());
        $errorHandler->register();
    }

    public static function loadConfig(): void
    {
        $configDefinitions = [
            'database' => Database::define(),
            'container' => Container::define(),
            'commands' => Commands::define(),
            'twig' => Twig::define(),
            'routes' => Routes::define(),
        ];

        $configValues = [
            'database' => Database::values(),
            'container' => Container::values(),
            'commands' => Commands::values(),
            'twig' => Twig::values(),
            'routes' => Routes::values(),
        ];

        static::$config = new Configuration($configDefinitions);
        static::$config->merge($configValues);
    }

    public static function loadContainer(): void
    {
        $definitions = static::$config->get('container.definitions');

        $containerBuilder = new ContainerBuilder();

        foreach ($definitions as $definition) {
            /** @var DefinitionInterface $class */
            $class = new $definition();
            $containerBuilder->addDefinitions($class->define());
        }

        static::$container = $containerBuilder->build();
    }

    public static function loadRouting(): void
    {
        $strategy = (new ApplicationStrategy)->setContainer(static::$container);
        static::$router = (new Router())->setStrategy($strategy);

        foreach (static::$config->get('routes') as $route) {
            foreach ($route['methods'] as $method) {
                $middlewares = [];
                if (empty($route['middleware']) === false) {
                    foreach ($route['middleware'] as $middleware) {
                        $middlewares[] = new $middleware;
                    }
                }

                static::$router->map(
                    $method,
                    $route['uri'],
                    $route['action']
                )->middlewares($middlewares);
            }
        }
    }

    public static function dispatchToAction(): void
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

        $dependencyFactory = DependencyFactory::fromConnection(
            new ConfigurationArray(static::$config->get('database.migrations')),
            new ExistingConnection(Connection::instance())
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