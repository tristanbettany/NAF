<?php

namespace Infrastructure\Schemas;

use Nette\Schema\Expect;
use Nette\Schema\Schema;

final class Database
{
    public static function define(): Schema
    {
        return Expect::structure([
            'connection' => Expect::structure([
                'host' => Expect::string()->default('localhost'),
                'port' => Expect::int()->min(1)->max(65535),
                'db_name' => Expect::string()->required(),
                'username' => Expect::string()->required(),
                'password' => Expect::string()->nullable(),
                'charset' => Expect::string()->required(),
            ]),
            'migrations' => Expect::structure([
                'table_storage' => Expect::structure([
                    'table_name' => Expect::string('doctrine_migration_versions'),
                    'version_column_name' => Expect::string('version'),
                    'version_column_length' => Expect::int(1024),
                    'executed_at_column_name' => Expect::string('executed_at'),
                    'execution_time_column_name' => Expect::string('execution_time'),
                ]),
                'migrations_paths' => Expect::array()->required(),
                'all_or_nothing' => Expect::bool()->required(),
                'check_database_platform' => Expect::bool(true),
                'organize_migrations' => Expect::string('none'),
                'connection' => Expect::string()->nullable(),
                'em' => Expect::string()->nullable(),
            ]),
        ]);
    }

    public static function values(): array
    {
        return include_once __DIR__ . '/../../Application/Config/database.php';
    }
}