<?php

namespace Infrastructure\Schemas;

use Nette\Schema\Expect;
use Nette\Schema\Schema;

final class Container
{
    public static function define(): Schema
    {
        return Expect::structure([
            'actions' => Expect::array()->required(),
            'service_providers' => Expect::array()->required(),
        ]);
    }

    public static function values(): array
    {
        return include_once __DIR__ . '/../../Application/Config/container.php';
    }
}