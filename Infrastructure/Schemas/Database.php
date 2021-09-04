<?php

namespace Infrastructure\Schemas;

use Nette\Schema\Expect;
use Nette\Schema\Schema;

final class Database
{
    public static function define(): Schema
    {
        return Expect::structure([
            'host' => Expect::string()->default('localhost'),
            'port' => Expect::int()->min(1)->max(65535),
            'db_name' => Expect::string()->required(),
            'username' => Expect::string()->required(),
            'password' => Expect::string()->nullable(),
            'charset' => Expect::string()->required(),
        ]);
    }

    public static function values(): array
    {
        return include_once __DIR__ . '/../../Application/Config/database.php';
    }
}