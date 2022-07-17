<?php

namespace Application\Config\Schemas;

use Nette\Schema\Expect;
use Nette\Schema\Schema;

final class Routes
{
    public static function define(): Schema
    {
        return Expect::array()->required();
    }

    public static function values(): array
    {
        return include_once __DIR__ . '/../routes.php';
    }
}