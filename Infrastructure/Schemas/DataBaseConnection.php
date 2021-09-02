<?php

namespace Infrastructure\Schemas;

use Nette\Schema\Expect;
use Nette\Schema\Schema;

final class DataBaseConnection
{
    public static function define(): Schema
    {
        return Expect::structure([
            'host' => Expect::string()->default('localhost'),
            'port' => Expect::int()->min(1)->max(65535),
            'database' => Expect::string()->required(),
            'username' => Expect::string()->required(),
            'password' => Expect::string()->nullable(),
        ]);
    }

    public static function values(): array
    {
        return include_once __DIR__ . '/../../Application/Config/database.php';
    }
}