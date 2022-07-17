<?php

namespace Application\Config\Schemas;

use Nette\Schema\Expect;
use Nette\Schema\Schema;

final class Container
{
    public static function define(): Schema
    {
        return Expect::structure([
            'definitions' => Expect::array()->required(),
        ]);
    }

    public static function values(): array
    {
        return include_once __DIR__ . '/../container.php';
    }
}