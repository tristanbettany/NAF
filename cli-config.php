<?php

require_once __DIR__ . '/vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\Migrations\Configuration\Connection\ExistingConnection;
use Doctrine\Migrations\DependencyFactory;
use Infrastructure\Core\Kernel;
use Doctrine\Migrations\Configuration\Migration\ConfigurationArray;
use Infrastructure\Facades\Config;

Kernel::loadEnv();
Kernel::loadConfig();

$connection = DriverManager::getConnection(
    [
        'dbname' => Config::get('database.connection.db_name'),
        'user' => Config::get('database.connection.username'),
        'password' => Config::get('database.connection.password'),
        'host' => Config::get('database.connection.host'),
        'driver' => 'pdo_mysql',
        'memory' => true,
    ]
);

return DependencyFactory::fromConnection(
    new ConfigurationArray(Config::get('database.migrations')),
    new ExistingConnection($connection)
);